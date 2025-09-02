<?php

use App\Models\Produk;
  
  namespace App\Http\Controllers;
  
  use App\Models\Produk;
  use Illuminate\Http\Request;
  
  class ProdukController extends Controller
  {
    public function index()
    {
      $produk = Produk::all();
      return response()->json($produk);
    }
  }
  
?>