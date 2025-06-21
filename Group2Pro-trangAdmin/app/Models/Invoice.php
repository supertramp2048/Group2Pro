<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'total_price',
        'created_at',
    ];
    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }


}

