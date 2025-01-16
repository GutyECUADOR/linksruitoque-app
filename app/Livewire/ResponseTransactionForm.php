<?php

namespace App\Livewire;

use App\Models\RequestInformation;
use Livewire\Component;
use Illuminate\Http\Request;

class ResponseTransactionForm extends Component
{
    public function mount(Request $request)
    {
        $reference = $request->route('reference'); // Obtiene el parámetro {reference}
        $requestInformation = RequestInformation::where('reference', $reference)->first();

        if ($requestInformation) {
            # code...
        } else {
            $requestInformation = new RequestInformation();
            //$requestInformation->save();
        }


    }

    public function render()
    {
        return view('livewire.response-transaction-form');
    }
}
