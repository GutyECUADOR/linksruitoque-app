<?php

namespace App\Livewire;

use App\Models\Invoice;
use Livewire\Component;

class AnulaFacturasForm extends Component
{

    public $numero_factura;
  
    protected $rules = [
        'numero_factura' => 'required'
    ];

    public function anularFactura()
    {
        $this->validate();
        $invoice = Invoice::where('numeroFactura', $this->numero_factura)->first();
        
        if ($invoice) {
            $invoice->status = 'CANCELED_BY_ADMIN';
            $invoice->save();
            session()->flash('message', 'Factura #'.$this->numero_factura . ' anulada exitosamente.');
        }else{
            $this->addError('numero_factura', 'Factura #'.$this->numero_factura . ' no existe.');
        }

        // Reset the file input
        $this->reset('numero_factura');
    
    }

    public function render()
    {
        return view('livewire.anula-facturas-form');
    }
}
