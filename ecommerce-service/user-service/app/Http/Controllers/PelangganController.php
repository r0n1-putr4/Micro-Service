<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        return json_encode([
            'status' => 'success',
            'data' => Pelanggan::all()
        ]);
    }

    public function show($id)
    {
        header('Access-Control-Allow-Origin: *');
        return json_encode(['status' => 'success', 'data' => Pelanggan::find($id)]);
    }
}
