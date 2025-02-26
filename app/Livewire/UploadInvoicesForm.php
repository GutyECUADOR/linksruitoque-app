<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Cliente;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UploadInvoicesForm extends Component
{
    use WithFileUploads;

    public $file;
    private $count_invoices = 0;

    protected $rules = [
        'file' => 'required|file|mimes:xlsx,csv,xls'
    ];

    public function import()
    {
        $this->validate();
        $this->count_invoices = 0;

        // Subir archivo temporalmente
        $filePath = $this->file->store('temp');
        $absolutePath = storage_path('app/' . $filePath);

        try {
            DB::transaction(function () use ($absolutePath) {
                // Leer y procesar el archivo
                $data = Excel::toArray([], $absolutePath)[0]; // Asume que la data está en la primera hoja
                $dataWithoutHeader = array_slice($data, 1); // Omitir la primera fila

                foreach ($dataWithoutHeader as $row) {
                    // Consultar cliente por DNI
                    $cliente = Cliente::where('numeroDocumentoIdentidad', $row[1])->first();

                    //dd($row[10]);

                    if (!$cliente) {
                        $cliente = Cliente::create([
                            'tipoDocumentoIdentidad'    => $row[0],
                            'numeroDocumentoIdentidad'  => $row[1],
                            'nombre'                    => $row[2],
                            'telefonoContacto'          => $row[3],
                            'email'                     => $row[4],
                            'direccionCorrespondencia'  => ''
                        ]);
                    }

                    // Crear la factura
                    $this->count_invoices++;

                    $baseDate = Carbon::createFromDate(1899, 12, 30);
                    // Sumar los días al número base
                    $convertedDate = $baseDate->addDays($row[10]); // Excel trae la fecha como un int (dias)

                    // Validacion VALOR
                    $valor = number_format((float)$row[7], 2, '.', '');

                    // Verificar si cumple con el límite de 8 dígitos
                    if (strlen(str_replace('.', '', $valor)) > 8) {
                        throw new \Exception('El valor de la factura #' . $row[1] . ' excede el formato DECIMAL(8,2).');
                    }

                    // Validacion VALOR VENCIDO
                    $valorVencido = number_format((float)$row[8], 2, '.', '');

                    // Verificar si cumple con el límite de 8 dígitos
                    if (strlen(str_replace('.', '', $valor)) > 8) {
                        throw new \Exception('El valor vencido de la factura #' . $row[1] . ' excede el formato DECIMAL(8,2).');
                    }

                    Invoice::create([
                        'cliente_id'      => $cliente->id,
                        'numeroFactura'   => $row[5],
                        'referenciaPago'  => $row[2],
                        'valor'           => $valor,
                        'valorVencido'    => $valorVencido,
                        'periodoCancelar' => $row[6],
                        'fechaLimitePago' => $convertedDate->toDateString(),
                        'status'          => 'UNPAYMENT',
                    ]);
                }
            });

            unlink($absolutePath); // Eliminar archivo temporal
            session()->flash('message', $this->count_invoices . ' facturas importadas exitosamente.');
            // Reset the file input
            $this->reset('file');

        } catch (\Throwable $th) {
            $this->reset('file');
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/upload-invoices.log'),
            ])->info(json_encode($th->getMessage()));

            if ($th->errorInfo[1] == 1062) { // Código de error 1062 = Duplicado
                $this->addError('file', 'Se está intentando cargar una factura duplicada');
            }else{
                $this->addError('file', $th->getMessage());
            }
        }
    }

    public function render()
    {
        return view('livewire.upload-invoices-form');
    }
}
