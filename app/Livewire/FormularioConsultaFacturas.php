<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class FormularioConsultaFacturas extends Component
{
    public $cedula;
    public $user;
    public $invoices = [];
    public $invoices_checked = [];
    public $total = 0;
    public $isSubmitting = false;

    protected $rules = [
        'cedula' => 'required|string|max:25'
    ];

    public function submit_cosultaFacturas()
    {
        try {
            $this->isSubmitting = true;
            $this->validate();


            // Lógica del componente
            $this->user = Cliente::where('numeroDocumentoIdentidad', $this->cedula)->first();

            // Verificar si no se encontró el usuario
            if (!$this->user) {
                $this->addError('cedula', 'No existe un cliente con ese número de identificación.');
                $this->invoices = [];
                return;

            }

            // Verificar si el usuario no tiene facturas
            if ($this->user->invoices->isEmpty()) {
                $this->invoices = [];
                session()->flash('status', 'No tienes facturas pendientes 🥳');
                return;
            }

            $this->invoices = $this->user->invoices->map(function ($invoice) {
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
        if ($this->invoices_checked->isEmpty()) {
            session()->flash('error', 'Debe seleccionar al menos una factura válida');
        }


        // Restablecer el estado después de enviar
        $this->isSubmitting = false;


    }

    public function actualizaValorTotal()
    {
        $this->total = collect($this->invoices)
        ->where('checked', true) // Filtrar facturas seleccionadas
        ->sum('valor'); // Sumar los valores seleccionados

        $this->invoices_checked = collect($this->invoices)
        ->where('checked', true);
    }

    public function render()
    {
        return view('livewire.formulario-consulta-facturas');
    }
}
