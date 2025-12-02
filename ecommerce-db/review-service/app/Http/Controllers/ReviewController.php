<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{

    private $client;

    public function getProduk($produk_id)
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => "http://172.25.163.108:1001"]);

        $url = $produk_id ? "/produk/{$produk_id}" : '/produk';
        $response = $this->client->request('GET', $url);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function store(Request $request)
    {
        try {

            $validate = $this->validate($request, [
                'customer_id' => 'required',
                'product_id' => 'required',
                'rating' => 'required',
                'comment' => 'required',
            ]);
            $getProduk = $this->getProduk($validate['product_id']);
            if (!$getProduk['success']) {
                return json_encode([
                    'status' => false,
                    'message' => 'Produk tidak ditemukan',
                ]);
            }
            print_r($getProduk);
            // $review = Review::create($validate);
            // return json_encode([
            //     'status' => true,
            //     'message' => 'Create Review',
            //     'data' => $review
            // ]);
        }catch(\Exception $e){
            return json_encode([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
