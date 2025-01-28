<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Invoice;
use App\Models\RequestInformation;
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

            $this->invoices = $this->cliente->pendingOrRejectedInvoices->map(function ($invoice) {
                $invoiceClone = clone $invoice;
                if ($invoice->status === 'UNPAYMENT') {
                    $invoiceClone->checked = true; // Nueva propiedad reactiva
                } else {
                    $invoiceClone->checked = false; // Nueva propiedad reactiva
                }
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

        try {
            // Control de doble pago
            $array_ids_invoices = array_filter(explode("-",  $this->invoice_reference));
            foreach ($array_ids_invoices as $invoice_id) {
                $invoice = Invoice::where('numeroFactura', $invoice_id)->where('status', 'PENDING')->first();
                //dd($invoice);
                if ($invoice) {
                    $this->addError('valor', "En este momento su factura #" . $invoice["numeroFactura"] . " por el valor de " . $invoice["valor"] . " se encuentra en un estado de PENDIENTE de no recibir confirmación por parte de su entidad financiera, por favor espere unos minutos y vuelva a consultar más tarde para verificar si su pago fue confirmado de forma exitosa. Si desea más información sobre el estado actual de su operación puede comunicarse a nuestras líneas de atención al cliente +57302 8623272 o enviar un correo electrónico a facturas@linkruitoque.com y preguntar por el estado de la transacción.");
                    return;
                }
            }

            // Lógica del componente
            $login = env("PLACE_TO_PAY_LOGIN");
            $secretKey = env("PLACE_TO_PAY_SECRET_KEY");
            $seed = Carbon::now()->toIso8601String(); //date('c');

            $rawNonce = rand();
            $tranKey = base64_encode(hash('sha256', $rawNonce . $seed . $secretKey, true));
            $nonce = base64_encode($rawNonce);
            $EXPIRATION_MINUTES_ADD = 15;

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
                "returnUrl" => env('PLACE_TO_PAY_RETURNURL') . '/' . $this->invoice_reference,
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

            $request = new Request('POST', env("PLACE_TO_PAY_BASE_URL") . '/api/session', $headers, json_encode($body));
            $response = $client->send($request);
            $jsonResponse = json_decode($response->getBody(), true);
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/place-to-pay-requests.log'),
            ])->info(json_encode([$jsonResponse]));

            /*Creación de Objeto RequestInformation para consulta de status posterior al redireccionamiento */
            $requestInformation = new RequestInformation();
            $requestInformation->requestId =  $jsonResponse["requestId"];
            $requestInformation->referencia = $this->invoice_reference;
            $requestInformation->save();

            /* TODO REGISTRO DE REQUEST ID con la referencia de factura */
            foreach ($this->invoices_checked as $invoice) {
                $invoice = Invoice::where('numeroFactura', $invoice["numeroFactura"])->first();
                $invoice->status = 'PENDING';
                $invoice->save();
            }
            $this->invoices = [];

            return redirect()->to($jsonResponse['processUrl']);
        } catch (\Throwable $th) {
            $this->addError('valor', 'No se pudo generar el pago, contacte a soporte. Code:' . $th->getMessage());
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/errors-place-to-pay-requests.log'),
            ])->info(json_encode($th->getMessage()));
        }
    }

    public function actualizaValorTotal()
    {
        $this->total = collect($this->invoices)
            ->where('checked', true) // Filtrar facturas seleccionadas
            //->sum('valor'); // Sumar los valores seleccionados
            ->reduce(function ($sum, $invoice) {
                // Convertir fecha límite de pago a formato sin hora
                $fechaLimitePago = Carbon::parse($invoice['fechaLimitePago'])->toDateString();
                $hoy = Carbon::now()->toDateString(); // También considerar solo la fecha actual

                if ($hoy <= $fechaLimitePago) {
                    return $sum + $invoice['valor'];
                } else {
                    return $sum + $invoice['valorVencido'];
                }
            }, 0);

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
