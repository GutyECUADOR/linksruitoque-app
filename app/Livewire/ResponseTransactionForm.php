<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class ResponseTransactionForm extends Component
{
    public function mount(Request $request)
    {
        //dd($request);
    }

    public function render()
    {
        return view('livewire.response-transaction-form');
    }
}
