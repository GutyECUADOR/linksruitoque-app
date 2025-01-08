<?php

namespace App\Livewire;

use App\Models\Cliente;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class FormularioConsultaFacturas extends Component
{
    public $cedula;
    public $cliente;
    public $invoices = [];
    public $invoices_checked = [];
    public $total = 0;
    public $isSubmitting = false;
    public $invoice_reference = '';
    public $invoice_reference_description = '';

    protected $rules = [
        'cedula' => 'required|string|max:25'
    ];

    public function submit_cosultaFacturas()
    {
        try {
            $this->isSubmitting = true;
            $this->validate();


            // Lógica del componente
            $this->cliente = Cliente::where('numeroDocumentoIdentidad', $this->cedula)->first();

            // Verificar si no se encontró el usuario
            if (!$this->cliente) {
                $this->addError('cedula', 'No existe un cliente con ese número de identificación.');
                $this->invoices = [];
                return;
            }

            // Verificar si el usuario no tiene facturas
            if ($this->cliente->pendingOrRejectedInvoices->isEmpty()) {
                $this->invoices = [];
                session()->flash('status', 'No tienes facturas pendientes 🥳');
                return;
            }

            $this->invoices = $this->cliente->invoices->map(function ($invoice) {
                $invoiceClone = clone $invoice;
                $invoiceClone->checked = true; // Nueva propiedad reactiva
                return $invoiceClone;
            })->toArray();

            $this->actualizaValorTotal();
            $this->isSubmitting = false;
        } catch (ValidationException $e) {
            $this->addError('cedula', $e->getMessage());
            $this->invoices = [];
        }
    }

    public function submit_pagarFacturas()
    {
        // Validaciones
        $this->isSubmitting = true;

        // Lógica del componente
        $login = env("PLACE_TO_PAY_LOGIN");
        $secretKey = env("PLACE_TO_PAY_SECRET_KEY");
        $seed = Carbon::now()->toIso8601String(); //date('c');

        $rawNonce = rand();
        $tranKey = base64_encode(hash('sha256', $rawNonce . $seed . $secretKey, true));
        $nonce = base64_encode($rawNonce);
        $EXPIRATION_MINUTES_ADD = 30;

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $body = [
            "locale" => "es_CO",
            "auth" => [
                "login" => $login,
                "tranKey" => $tranKey,
                "nonce" => $nonce,
                "seed" => $seed,
            ],
            "payment" => [
                "reference" => $this->invoice_reference,
                "description" => $this->invoice_reference_description,
                "amount" => [
                    "currency" => env('PLACE_TO_PAY_MONEDA'),
                    "total" => $this->total
                ]
            ],
            "expiration" => Carbon::now()->addMinute($EXPIRATION_MINUTES_ADD)->toIso8601String(),
            "returnUrl" => env('PLACE_TO_PAY_RETURNURL'),
            "ipAddress" => $_SERVER['REMOTE_ADDR'],
            "userAgent" => $_SERVER['HTTP_USER_AGENT']
        ];

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/place-to-pay-requests.log'),
        ])->info(json_encode([$body]));

        // Inicializar el cliente HTTP Guzzle
        $client = new Client([
            'base_uri' => env("PLACE_TO_PAY_BASE_URL"),
            'timeout'  => 10.0,
        ]);

        try {
            $request = new Request('POST', 'https://checkout.test.goupagos.com.co/api/session', $headers, json_encode($body));
            $response = $client->send($request);
            $jsonResponse = json_decode($response->getBody(), true);
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/place-to-pay-requests.log'),
            ])->info(json_encode([$jsonResponse]));

            return redirect()->to($jsonResponse['processUrl']);
        } catch (\Throwable $th) {
            $this->addError('valor', 'No se pudo generar el pago, contacte a soporte. Code:'.$th->getMessage());
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/errors-place-to-pay-requests.log'),
            ])->info(json_encode($th->getMessage()));
        } finally {

            $this->isSubmitting = false;

        }
    }

    public function actualizaValorTotal()
    {
        $this->total = collect($this->invoices)
            ->where('checked', true) // Filtrar facturas seleccionadas
            ->sum('valor'); // Sumar los valores seleccionados

        $this->invoices_checked = collect($this->invoices)
            ->where('checked', true);

        $this->invoice_reference = '';
        $this->invoice_reference_description = '';
        foreach ($this->invoices_checked as $invoice) {
            $this->invoice_reference = $this->invoice_reference . $invoice["numeroFactura"] . '-';
            $this->invoice_reference_description = $this->invoice_reference_description . ' Factura# ' . $invoice["numeroFactura"];
        }
    }

    public function render()
    {
        return view('livewire.formulario-consulta-facturas');
    }
}
