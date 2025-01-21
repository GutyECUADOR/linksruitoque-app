<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\RequestInformation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class CheckStatusInvoices extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-status-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica el estado de las facturas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $requestInformations = RequestInformation::where('status', ['PENDING'])->orWhereNull('status')->get();

        foreach ($requestInformations as $requestInformation) {

            $login = env("PLACE_TO_PAY_LOGIN");
            $secretKey = env("PLACE_TO_PAY_SECRET_KEY");
            $seed = Carbon::now()->toIso8601String();
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

                $request = new GuzzleRequest('POST', env("PLACE_TO_PAY_BASE_URL") . '/api/session/' . $requestInformation->requestId, $headers, json_encode($body));
                $response = $client->send($request);
                $jsonResponse = json_decode($response->getBody(), true);

                $requestInformation->status = $jsonResponse["status"]["status"];
                $requestInformation->date = $jsonResponse["status"]["date"];
                $requestInformation->valorTotal = $jsonResponse["request"]["payment"]["amount"]["total"];
                $requestInformation->moneda = $jsonResponse["request"]["payment"]["amount"]["currency"];
                $requestInformation->save();

                $array_ids_invoices = array_filter(explode("-", $requestInformation->referencia));
                foreach ($array_ids_invoices as $invoice_id) {
                    $invoice = Invoice::where('numeroFactura', $invoice_id)->first();
                    $invoice->status = $requestInformation->status;
                    $invoice->save();
                }

                Log::build([
                    'driver' => 'single',
                    'path' => storage_path('success-place-to-pay-requestsInformation.log'),
                ])->info(json_encode($requestInformation));

            } catch (\Throwable $th) {
                Log::build([
                    'driver' => 'single',
                    'path' => storage_path('logs/errors-place-to-pay-requestsInformation.log'),
                ])->info(json_encode($th->getMessage()));
            }
        }

        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/CRON-jobs.log'),
        ])->info(json_encode($requestInformations));
        // Escribe aquí tu lógica

        $this->info('El comando se ejecutó correctamente.');
        return Command::SUCCESS;
    }
}
