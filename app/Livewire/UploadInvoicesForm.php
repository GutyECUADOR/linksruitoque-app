<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Cliente;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

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

                foreach ($data as $row) {
                    // Consultar cliente por DNI
                    $cliente = Cliente::where('numeroDocumentoIdentidad', $row[0])->first();

                    if ($cliente) {
                        // Crear la factura
                        $this->count_invoices++;
                        Invoice::create([
                            'cliente_id'      => $cliente->id,
                            'numeroFactura'   => $row[1],
                            'referenciaPago'  => $row[2],
                            'valor'           => $row[3],
                            'valorVencido'    => $row[4],
                            'periodoCancelar' => $row[5],
                            'fechaLimitePago' => $row[6],
                            'status'          => 'UNPAYMENT',
                        ]);
                    }
                }
            });

            unlink($absolutePath); // Eliminar archivo temporal
            session()->flash('message', $this->count_invoices.' facturas importadas exitosamente.');

        } catch (\Throwable $th) {
            $this->addError('file', $th->getMessage());
        }


    }

    public function render()
    {
        return view('livewire.upload-invoices-form');
    }
}
