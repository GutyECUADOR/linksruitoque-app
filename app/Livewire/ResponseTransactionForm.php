<?php

namespace App\Livewire;

use App\Models\Invoice;
use App\Models\RequestInformation;
use Carbon\Carbon;
use Livewire\Component;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

class ResponseTransactionForm extends Component
{
    public $requestInformation = null;

    public function mount(Request $request)
    {
        $referencia = $request->route('referencia'); // Obtiene el parámetro {referencia} desde la URL de retorno
        $this->requestInformation = RequestInformation::where('referencia', $referencia)->latest()->first();

        if (!$this->requestInformation) {
            return redirect()->to('/');
        }

        $requestId = $this->requestInformation->requestId;

        if (is_null($this->requestInformation["status"]) || is_null($this->requestInformation["date"]) || is_null($this->requestInformation["valorTotal"]) || is_null($this->requestInformation["moneda"])) { /* Evitar doble peticion al endpoint de placetopay */
            # Peticion al API RequestInformation
            $login = env("PLACE_TO_PAY_LOGIN");
            $secretKey = env("PLACE_TO_PAY_SECRET_KEY");
            $seed = Carbon::now()->toIso8601String(); //date('c');

            $rawNonce = rand();
            $tranKey = base64_encode(hash('sha256', $rawNonce . $seed . $secretKey, true));
            $nonce = base64_encode($rawNonce);

            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];

            $body = [
                "auth" => [
                    "login" => $login,
                    "tranKey" => $tranKey,
                    "nonce" => $nonce,
                    "seed" => $seed,
                ]
            ];

            try {
                // Inicializar el cliente HTTP Guzzle
                $client = new Client([
                    'base_uri' => env("PLACE_TO_PAY_BASE_URL"),
                    'timeout'  => 10.0,
                ]);

                $request = new GuzzleRequest('POST', env("PLACE_TO_PAY_BASE_URL") . '/api/session/' . $requestId, $headers, json_encode($body));
                $response = $client->send($request);
                $jsonResponse = json_decode($response->getBody(), true);

                $this->requestInformation->requestId = $jsonResponse["requestId"];
                $this->requestInformation->referencia = $jsonResponse["request"]["payment"]["reference"];
                $this->requestInformation->status = $jsonResponse["status"]["status"];

                $datetime = new \DateTime($jsonResponse["status"]["date"]);
                $formattedDate = $datetime->format('Y-m-d H:i:s');

                $this->requestInformation->date = $formattedDate;
                $this->requestInformation->valorTotal = $jsonResponse["request"]["payment"]["amount"]["total"];
                $this->requestInformation->moneda = $jsonResponse["request"]["payment"]["amount"]["currency"];
                $this->requestInformation->save();

                $array_ids_invoices = array_filter(explode("-", $this->requestInformation->referencia));
                foreach ($array_ids_invoices as $invoice_id) {
                    $invoice = Invoice::where('numeroFactura', $invoice_id)->first();
                    $invoice->status = $this->requestInformation->status;
                    $invoice->save();
                }

                Log::build([
                    'driver' => 'single',
                    'path' => storage_path('logs/success-place-to-pay-requestsInformation.log'),
                ])->info(json_encode($this->requestInformation));

            } catch (\Throwable $th) {
                $this->addError('valor', 'No se pudo obtener la información de la transacción, contacte a soporte. Code:' . $th->getMessage());
                Log::build([
                    'driver' => 'single',
                    'path' => storage_path('logs/errors-place-to-pay-requestsInformation.log'),
                ])->info(json_encode($th->getMessage()));
            }
        }
    }

    public function render()
    {
        return view('livewire.response-transaction-form');
    }
}
