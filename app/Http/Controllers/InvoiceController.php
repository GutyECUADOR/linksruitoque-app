<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('invoices.index');
    }

    public function consultar(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string|max:25'
        ]);

        $user = Cliente::where('numeroDocumentoIdentidad', $request->cedula)->first();
        dd($user);
        return view('invoices.index');
    }


}
