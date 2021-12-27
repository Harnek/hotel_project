<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::where('order_id', $id)->first();
        if (!$order) {
            return abort(404);
        }

        return view('order')
            ->with(['order' => $order]);
    }
}
