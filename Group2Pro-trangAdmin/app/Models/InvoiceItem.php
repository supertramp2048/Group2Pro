<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'invoice_items';
    public $timestamps = false;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
    ];

    // Quan hệ với bảng hóa đơn
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    // Quan hệ với sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Truy xuất nhanh các trường sản phẩm hay dùng
    public function getProductTitleAttribute()
    {
        return $this->product->title ?? '';
    }

    public function getProductPriceAttribute()
    {
        return $this->product->price ?? 0;
    }

    public function getProductBrandAttribute()
    {
        return $this->product->brand ?? '';
    }
}
