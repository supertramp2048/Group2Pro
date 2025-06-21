<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
     protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'userName', 'email', 'password', 'admin'
    ];

    protected $casts = [
        'admin' => 'boolean',
    ];
}
