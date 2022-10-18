<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Cassandra\Custom;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('customers.index',[
           'customers' => Customer::where('created_by',auth()->id())->get()
        ]);
    }

    public function show(Customer $customer){
        return view('customers.show',[
           'customer' => $customer
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required'
        ]);
        Customer::create(array_merge($data,[
            'created_by' => auth()->id()
        ]));
        return back();
    }
}
