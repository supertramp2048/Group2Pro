<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    public $timestamps = false; // Vì bạn chỉ dùng created_at, không dùng updated_at

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'note',
        'total_price',
        'created_at',
    ];

    // Quan hệ 1-n với các invoice items
    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    // Lấy toàn bộ sản phẩm trong hóa đơn thông qua invoice_items
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,       // Model đích
            InvoiceItem::class,   // Model trung gian
            'invoice_id',         // Khóa ngoại ở bảng trung gian
            'id',                 // Khóa chính của bảng products
            'id',                 // Khóa chính bảng invoices
            'product_id'          // Khóa ngoại ở invoice_items trỏ đến products
        );
    }
}
