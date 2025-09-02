<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk
{
    public $list_produk = [
        [
            'id' => 1,
            'name' => 'produk 1',
            'price' => 10000
        ],
        [
            'id' => 2,
            'name' => 'produk 2',
            'price' => 20000
        ],
        [
            'id' => 3,
            'name' => 'produk 3',
            'price' => 30000
        ]
    ];

    public static function all()
    {
        return self::$list_produk;
    }
}
