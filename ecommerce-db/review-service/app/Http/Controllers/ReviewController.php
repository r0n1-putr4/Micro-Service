<?php

namespace App\Http\Controllers;

use App\Models\Review;
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

    public function getcustomer($customer_id)
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => "http://172.25.163.108:2001"]);

        $url = $customer_id ? "/api/customer/{$customer_id}" : '/api/customer';
        $response = $this->client->request('GET', $url);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function index(){
        try{

            
        }catch(\Exception $e){
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
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
                    'success' => false,
                    'message' => 'Produk tidak ditemukan',
                ]);
            }
            $getCustomer = $this->getcustomer($validate['customer_id']);
            if (!$getCustomer['success']) {
                return json_encode([
                    'success' => false,
                    'message' => 'Customer tidak ditemukan',
                ]);
            }
            $review = Review::create($validate);
            return json_encode([
                'success' => true,
                'message' => 'Create Review',
                'data' => $review
            ]);
        }catch(\Exception $e){
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
