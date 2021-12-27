<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

use PDF;

class InvoiceController extends Controller
{
    public function show($id) {
        $order = Order::where('order_id', $id)->first();

        if (!$order) {
            return abort(404);
        }

        $order_data = array();
        foreach($order->category_id as $category_id => $count) {
            $category = RoomCategory::where('id', $category_id);
            $category_name = $category->pluck('name')->first();
            $category_price = $category->pluck($order->price)->first();

            array_push($order_data, ["name" => $category_name, "room_num" => $count, 'price' => $category_price]);
        }

        $customer = Customer::where('id', $order->customer_id)->first();
        
        $prices_name = array(
            "price1" => "Food not included",
            "price2" => "Includes Breakfast",
            "price3" => "Includes Breakfast with lunch or dinner",
            "price4" => "Includes Full Meal Course",
        );

        $data = [
            'order_id' => $order->order_id,
            'order_date' => date('Y-m-d', strtotime($order->order_created)),
            'order_status' => $order->order_status,
            'payment_status' => $order->payment_status,
            'name' => $customer->firstname . ' ' . $customer->lastname,
            'phone' => $customer->phone,
            'email' => $customer->email,
            'order_data' => $order_data,
            'check_in' => date('Y-m-d', strtotime($order->check_in)),
            'check_out' => date('Y-m-d', strtotime($order->check_out)),
            'price_name' => $prices_name[$order->price],

            'discount' => $order->discount,
            'tax_percentage' => $order->tax_percentage,

            'amount' => $order->amount,
            'total' => $order->total,
        ];

        $pdf = PDF::loadView('invoices.booking', $data);
        
        return $pdf->stream('products.pdf');
    }
}
