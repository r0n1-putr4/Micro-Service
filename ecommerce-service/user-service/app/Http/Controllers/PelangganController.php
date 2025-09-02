<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {

        return json_encode([
            'status' => 'success',
            'data' => Pelanggan::all()
        ]);
    }

    public function show($id)
    {
        return json_encode(['status' => 'success', 'data' => Pelanggan::find($id)]);
    }
}
