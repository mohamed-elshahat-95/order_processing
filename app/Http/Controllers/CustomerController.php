<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class CustomerController extends Controller
{
    public function getCustomerByID($id){
        // Using Eloquent ORM...
        // $customerData = Customers::find($id);
        // dd($customerData);

        // Using Redis...  => set values done via Fill Redis Command file 
        // $customerData = Redis::get("customer_id_$id");
        // $customerData = json_decode($customerData);
        // dd($customerData);

        // Using Cache... (Redis Driver .env) => set values done via Fill Cache Command file 
        $customerData = Cache::get("customer_id_$id");
        dd($customerData);
    }
}
