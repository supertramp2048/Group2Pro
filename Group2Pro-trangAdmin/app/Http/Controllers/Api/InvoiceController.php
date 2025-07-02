<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Trả về danh sách tất cả hóa đơn kèm theo các sản phẩm bên trong.
     */
    public function index()
    {
        // Lấy tất cả hóa đơn kèm items và sản phẩm trong mỗi item
        $invoices = Invoice::with('items.product')->get();

        return response()->json($invoices);
    }

    /**
     * Hiển thị 1 hóa đơn cụ thể kèm sản phẩm chi tiết bên trong.
     */
    public function show($id)
    {
        $invoice = Invoice::with('items.product')->findOrFail($id);

        return response()->json($invoice);
    }
}
