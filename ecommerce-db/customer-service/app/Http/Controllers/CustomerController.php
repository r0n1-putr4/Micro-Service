<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        try {
            return json_encode([
                'success' => true,
                'message' => 'List Customer',
                'data' => Customer::all()
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {
            $customer = Customer::find($id);

            if (!$customer) {
                return json_encode([
                    'success' => false,
                    'message' => 'Customer tidak ditemukan',
                    'data' => null
                ]);
            }

            return json_encode([
                'success' => true,
                'message' => 'Detail Customer',
                'data' => $customer
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
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'password' => 'required',
                'image' => 'required',
            ]);

            $customer = Customer::create($validate);
            
            return json_encode([
                'success' => true,
                'message' => 'Create Customer',
                'data' => $customer
            ]);
            
        }catch(\Exception $e){
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id){
        try {
            $customer = Customer::find($id);
            $customer->update($request->all());
            return json_encode([
                'status' => true,
                'message' => 'Update Customer',
                'data' => $customer
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id){
       try {
           $customer = Customer::find($id);
           if (!$customer) {
               return json_encode([
                   'status' => false,
                   'message' => 'Customer Not Found',
               ]);
           }
           $customer->delete();
           return json_encode([
               'status' => true,
               'message' => 'Delete Customer',
           ]);
       } catch (\Exception $e) {
           return json_encode([
               'status' => false,
               'message' => $e->getMessage()
           ]);
       }        
    }

  
}
