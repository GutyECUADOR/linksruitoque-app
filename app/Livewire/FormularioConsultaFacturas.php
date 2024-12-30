<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class FormularioConsultaFacturas extends Component
{
    public $cedula;
    public $user;
    public $invoices = []; // Arreglo de ítems con valores y estados de checkbox
    public $total = 0; 
    public $isSubmitting = false;

    protected $rules = [
        'cedula' => 'required|string|max:25'
    ];

    public function submit()
    {
        // Validaciones

        $this->isSubmitting = true;
        $this->validate();

        // Lógica del componente
        $this->user = Cliente::where('numeroDocumentoIdentidad', $this->cedula)->first();
        //dd($this->user->invoices);

        if (!$this->user->invoices) {
            session()->flash('message', '¡No tienes facturas pendientes!');
            $this->isSubmitting = false;
            return;
        }

        $this->invoices = $this->user->invoices->map(function ($invoice) {
            $invoiceClone = clone $invoice; 
            $invoiceClone->checked = true; // Nueva propiedad
            $invoiceClone->valor = $invoiceClone->valor ?? 0; // Asegura un valor numérico
            return $invoiceClone;
        });
        
        //dd($this->invoices[0]->referenciaPago);
        // Restablecer el estado después de enviar
        $this->isSubmitting = false;

        // Opcionalmente, limpiar los campos
        $this->reset('cedula');
    }

    public function updatedInvoices($value, $key)
    {
    // Recalcula el total basado en las facturas seleccionadas
    $this->total = collect($this->invoices)
        ->where('checked', true)
        ->sum('valor');
    }

    public function render()
    {
        return view('livewire.formulario-consulta-facturas');
    }
}
