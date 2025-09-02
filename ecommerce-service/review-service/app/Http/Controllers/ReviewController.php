<?php

namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends Controller
{
    private $client;
    public function getProduk($produk_id)
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => "http://localhost:3001"]);

        $url = $produk_id ? "/produk/{$produk_id}" : '/produk';
        $response = $this->client->request('GET', $url);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function getPelanggan($pelanggan_id){
        $this->client = new \GuzzleHttp\Client(['base_uri' => "http://localhost:3003"]);

        $url = $pelanggan_id ? "/pelanggan/{$pelanggan_id}" : '/pelanggan';
        $response = $this->client->request('GET', $url);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function getReview($produk_id)
    {
        $review = Review::all();
        $hasil_review = [];

        foreach ($review as $key => $value) {
            if ($value['produk_id'] == $produk_id) {
                $hasil_review[$key] = $value;
                $hasil_review[$key]['pelanggan'] = $this->getPelanggan($value['user_id']);
            }
        }

        return json_encode([
            'status' => 'success',
            'produk' => $this->getProduk($produk_id),
            'data' => $hasil_review
        ]);
    }
}
