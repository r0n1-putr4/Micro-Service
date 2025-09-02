<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Produk;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
  public function index()
  {
    header('Access-Control-Allow-Origin: *');
    try {
      $produk = Produk::all();
      return ResponseHelper::successResponse('success', $produk);
    } catch (\Throwable $th) {
      Log::error([
        'message' => $th->getMessage(),
        'file' => $th->getFile(),
        'line' => $th->getLine()
      ]);
      return ResponseHelper::errorResponse($th->getMessage());
    }
  }

  public function show($id)
  {
    header('Access-Control-Allow-Origin: *');
    try {
      $produk = Produk::find($id);
      if (!$produk) {
        return ResponseHelper::errorResponse('Produk not found');
      }
      return ResponseHelper::successResponse('success', $produk);
    } catch (\Throwable $th) {
      Log::error([
        'message' => $th->getMessage(),
        'file' => $th->getFile(),
        'line' => $th->getLine()
      ]);
      return ResponseHelper::errorResponse($th->getMessage());
    }
  }
}
