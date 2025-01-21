<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\RequestInformation;
use Illuminate\Http\Request;

class IPNPagoPlaceToPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $IPN_invoice = $request->all();
        $signature = $IPN_invoice["signature"];

        $requestId = $IPN_invoice["requestId"];
        $status = $IPN_invoice["status"]["status"];
        $date = $IPN_invoice["status"]["date"];
        $secretKey = env("PLACE_TO_PAY_SECRET_KEY");

        $signature_check = hash('sha1', $requestId . $status . $date . $secretKey);

        if ($signature === $signature_check) {
            $reference_id_invoices = $IPN_invoice["reference"];
            $array_ids_invoices = array_filter(explode("-", $reference_id_invoices));
            foreach ($array_ids_invoices as $invoice_id) {
                $invoice = Invoice::where('numeroFactura', $invoice_id)->firstOrFail();
                $invoice->status = $status;
                $invoice->save();
                
                $requestInformation = RequestInformation::where('requestId', $IPN_invoice["requestId"])->firstOrFail();
                $requestInformation->status = $status;
                $requestInformation->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Operación realizada correctamente',
                'invoices' => $array_ids_invoices
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Operación no autorizada',
            ], 403);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
