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
    
        if (!$this->user->invoices) {
            session()->flash('message', '¡No tienes facturas pendientes!');
            $this->isSubmitting = false;
            return;
        }

        $this->invoices = $this->user->invoices->map(function ($invoice) {
            $invoiceClone = clone $invoice; 
            $invoiceClone->checked = false; // Nueva propiedad reactiva
            return $invoiceClone;
        })->toArray();
        
        //dd($this->invoices);
        // Restablecer el estado después de enviar
        $this->isSubmitting = false;

        // Opcionalmente, limpiar los campos
        $this->reset('cedula');
    }

    public function actualizaValorTotal()
    {
        $this->total = collect($this->invoices)
        ->where('checked', true) // Filtrar facturas seleccionadas
        ->sum('valor'); // Sumar los valores seleccionados
    }

    public function render()
    {
        return view('livewire.formulario-consulta-facturas');
    }
}
