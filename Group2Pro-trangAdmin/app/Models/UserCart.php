<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;
    protected $table = 'user_cart';
    public $timestamps = false;

    protected $fillable = ['userId', 'productId', 'addDate'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
