<?php

namespace App\Livewire;

use App\Models\RequestInformation;
use Carbon\Carbon;
use Livewire\Component;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResponseTransactionForm extends Component
{
    public function mount(Request $request)
    {
        $referencia = $request->route('referencia'); // Obtiene el parámetro {reference}
        $requestInformation = RequestInformation::where('referencia', $referencia)->first();
        $requestId = '63525';

        if ($requestInformation) {
            # code...
        } else {

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

                //dd($jsonResponse);
                $requestInformation = new RequestInformation();
                $requestInformation->requestId = $jsonResponse["requestId"];
                $requestInformation->referencia = $jsonResponse["request"]["payment"]["reference"];
                $requestInformation->status = $jsonResponse["status"]["status"];
                $requestInformation->date = $jsonResponse["status"]["date"];
                $requestInformation->valorTotal = $jsonResponse["request"]["payment"]["amount"]["total"];
                $requestInformation->moneda = $jsonResponse["request"]["payment"]["amount"]["currency"];
                $requestInformation->save();

            } catch (\Throwable $th) {
                //dd(json_decode($response->getBody(), true));
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
