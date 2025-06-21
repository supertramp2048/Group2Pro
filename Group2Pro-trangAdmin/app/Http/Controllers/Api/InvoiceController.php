<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    public function index()
    {

        return Invoice::with('items')->get();
    }


    /**
     * Hiển thị 1 hóa đơn cụ thể (kèm items).
     */
    public function show($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);
        return response()->json($invoice);
    }


    /**
     * Xoá hóa đơn (và toàn bộ invoice_items nhờ ON DELETE CASCADE).
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return response()->noContent();
    }


}
