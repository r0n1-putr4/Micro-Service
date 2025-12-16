<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    private $client;

    public function getProduk($produk_id)
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => "http://host.docker.internal:1001"]);

        $url = $produk_id ? "/produk/{$produk_id}" : '/produk';
        $response = $this->client->request('GET', $url);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function getcustomer($customer_id)
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => "http://host.docker.internal:2001"]);

        $url = $customer_id ? "/api/customer/{$customer_id}" : '/api/customer';
        $response = $this->client->request('GET', $url);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function index($produk_id)
    {
        try {

            $review = Review::where('product_id', $produk_id)->get();;
            $hasil_review = [];

            foreach ($review as $key => $value) {
                $hasil_review[$key] = $value;
                $data_customer = $this->getcustomer($value['customer_id']);
                $hasil_review[$key]['customer'] = $data_customer['data'];
            }

            return json_encode([
                'status' => 'success',
                // 'produk' => $this->getProduk($produk_id),
                'data' => $hasil_review
            ]);
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
