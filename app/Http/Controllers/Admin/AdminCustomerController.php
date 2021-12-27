<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return $customers;
        // return view('admin.customer.index')
        //     ->with(['customers' => $customers]);
    }

    public function show($id)
    {
        $customer = Customer::where('id', $id)->first();

        if (!$customer) {
            return abort(404);
        }

        return $customer;
    }
}
