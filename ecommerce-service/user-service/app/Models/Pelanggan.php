<?php

namespace App\Models;

class Pelanggan {
    public static $users = [
        [
            'id' => 1,
            'username' => 'rn.putra@gmail.com',
            'password' => '123456',
            'nama' => 'Roni Putra',
            'alamat' => 'Jl. Kebon Jeruk No. 123, Jakarta Selatan',
            'telepon' => '08123456789',          

        ],
        [
            'id' => 2,
            'username' => 'dani@gmail.com',
            'password' => '123456',
            'nama' => 'Dani',
            'alamat' => 'Jl. Kebon Jeruk No. 123, Jakarta Selatan',
            'telepon' => '08123456789',
        ]
    ];

    public static function all() {
        return self::$users;
    }

    public static function find($id) {
        foreach (self::$users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }
}