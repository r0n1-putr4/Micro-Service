<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model{
    protected $table = 'tb_customers';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'image'
    ];

}