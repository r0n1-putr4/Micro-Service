<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Review extends Model
{
    use HasFactory;
    protected $table = 'tb_reviews';
    protected $fillable = [
        'customer_id',
        'product_id',
        'rating',
        'comment',
    ];
}