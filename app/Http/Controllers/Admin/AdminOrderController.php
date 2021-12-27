<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use paytm\paytmchecksum\PaytmChecksum;
use PDF;

use function PHPUnit\Framework\isNull;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('created_at', 'DESC')->Paginate(10);

        $customer_ids = array();
        foreach ($orders as $order) {
            array_push($customer_ids, $order->customer_id);
        }

        $customers = Customer::find($customer_ids);
        foreach ($orders as $order) {
            $customer = $customers->where('id', $order->customer_id)->first();
            $order->customer = $customer->firstname . ' ' . $customer->lastname;
        };
        $data = json_decode($orders->toJSON());

        return view('admin.order.index')->with([
            'orders' => $orders,
            'start' => 10 * ($data->current_page - 1),
        ]);
    }

    public function create(Request $request)
    {
        if (!$request->has('check_in') || !$request->has('check_out') || !$request->has('room_id')) {
            return redirect(route('admin.search'))->with(['fail' => 'Please select a room']);
        }

        $validator = Validator::make($request->all(), [
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'room_id' => 'required|array',
            'room_id.*' => 'required|exists:rooms,id',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.search'))->with(['fail' => 'Invalid Input']);
        }

        $data = $validator->validated();
        $check_in = $data['check_in'];
        $check_out = $data['check_out'];
        $room_ids = $data['room_id'];

        foreach ($room_ids as $id) {
            if (!$this->roomAvailable($id, $check_in, $check_out)) {
                return redirect(route('admin.search'))
                    ->with(['fail' => 'Some rooms not available anymore']);
            }
        }

        $categories_temp = RoomCategory::all(['id', 'name']);
        $categories = array();

        foreach ($categories_temp as $temp) {
            $categories[$temp->id] = $temp->name;
        }

        $rooms = Room::whereIn('id', $room_ids)->get();
        foreach ($rooms as $room) {
            $room->category_name = $categories[$room->category_id];
        };

        return view('admin.order.create')
            ->with(['check_in' => $check_in])
            ->with(['check_out' => $check_out])
            ->with(['rooms' => $rooms]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'room_id' => 'required|array',
            'room_id.*' => 'required|exists:rooms,id',
            'firstname' => 'required|max:255',
            'lastname' => 'nullable|max:255',
            'phone' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|max:5000',
            'guests' => 'required|numeric',
            'price' => 'required|in:price1,price2,price3,price4',
            'payment_method' => 'required|in:paytm,cash,other',
            'payment_status' => 'required|in:paid,pending',
        ]);

        $tax_percentage = (float) Setting::where('key', 'tax_percentage')->pluck('value')->first();
        $discount_percentage = (float) Setting::where('key', 'discount_percentage')->pluck('value')->first();

        if (is_null($tax_percentage) || is_null($discount_percentage)) {
            return redirect(route('admin.search'))
                ->with(['fail' => 'Server Error. Please contact us for further assistance.']);
        }

        $customer = Customer::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'] ?? '',
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        $categories = RoomCategory::all();
        $rooms = Room::whereIn('id', $data['room_id'])->get();

        $category_id = array();
        $amount = 0;
        foreach ($rooms as $room) {
            if (!array_key_exists($room->category_id, $category_id)) {
                $category_id[$room->category_id] = 0;
            }
            $category_id[$room->category_id] += 1;
            $amount += $categories->where('id', $room->category_id)->pluck($data['price'])->first();
        }

        $days = date_diff(date_create_from_format('Y-m-d', $data['check_in']), date_create_from_format('Y-m-d', $data['check_out']));
        $amount *= $days->d;

        $discount = 0;
        if ($discount_percentage > 0) {
            $discount = (((float) $amount * (float) $discount_percentage) / 100);
        }
        $amount -= $discount;

        $tax = (((float) $amount * (float) $tax_percentage) / 100);
        $total = round((float) $amount + $tax, 6);

        foreach ($rooms as $room) {
            if (!$this->roomAvailable($room->id, $data['check_in'], $data['check_out'])) {
                return redirect(route('admin.search'))
                    ->with(['fail' => 'Some rooms not available anymore']);
            }
        }

        $order_id = $this->generateOrderId();
        $order = Order::create([
            'order_id'  => $order_id,
            'order_status'  => 'pending',
            'order_created' => date('Y-m-d'),
            'payment_method' => $data['payment_method'],
            'payment_status'  => $data['payment_status'],
            'currency'  => 'INR',
            'total'    => $total,

            'category_id' => $category_id,
            'check_in'  => $data['check_in'],
            'check_out' => $data['check_out'],
            'rooms'     => count($rooms),
            'guests'    => $data['guests'],
            'notes'     => $data['notes'] ?? null,

            'price' => $data['price'],
            'discount' => $discount,
            'tax_percentage' => $tax_percentage,
            'tax' => $tax,
            'amount'    => $amount,

            'customer_id' => $customer->id,
        ]);

        foreach ($rooms as $room) {
            Booking::create([
                'room_id' => $room->id,
                'category_id' => $room->category_id,
                'customer_id' => $order->customer_id,
                'order_id' => $order->id,
                'check_in' => $order->check_in,
                'check_out' => $order->check_out,
                'guests' => $order->guests,
                'notes' => $order->notes,
            ]);
        }

        if ($order->order_status == 'pending') {
            $order->update(['order_status' => 'processed']);
        }

        return redirect(url(route('admin.orders') . '/' . $order->id));
    }

    public function edit($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return abort(404);
        }

        if ($order->payment_method == 'paytm') {
            return redirect(url(route('admin.orders') . '/' . $order->id))
                ->with(['fail' => 'Cannot modify order paid using paytm.']);
        }

        $customer = Customer::where('id', $order->customer_id)->first();

        return view('admin.order.edit')->with([
            'order' => $order,
            'customer' => $customer,
        ]);
    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'id' => 'required|exists:orders,id',
            'payment_status' => 'required|in:paid,pending',
        ]);

        $order = Order::where('id', $data['id'])->first();

        if (!$order) {
            return abort(404);
        }

        if ($order->payment_method == 'paytm') {
            return redirect(url(route('admin.orders') . '/' . $order->id))
                ->with(['fail' => 'Cannot modify order paid using paytm.']);
        }

        $order->update(['payment_status' => $data['payment_status']]);

        return redirect(url(route('admin.orders') . '/' . $order->id))
            ->with(['message' => 'Order updated successfully.']);
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return abort(404);
        }

        $bookings = Booking::where('order_id', $order->id)->get();
        foreach ($bookings as $booking) {
            $booking->update(['cancelled' => true]);
        }

        $order->update(['order_status' => 'cancelled']);

        return redirect(url(route('admin.orders') . '/' . $order->id))
            ->with(['message' => 'Order cancelled successfully.']);
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return abort(404);
        }

        $customer = Customer::where('id', $order->customer_id)->first();
        $bookings = Booking::where('order_id', $order->id)->get();

        return view('admin.order.view')
            ->with(['order' => $order])
            ->with(['customer' => $customer])
            ->with(['bookings' => $bookings]);
    }

    public function invoice($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return abort(404);
        }

        $order_data = array();
        foreach ($order->category_id as $category_id => $count) {
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

    public function updatePayment($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return abort(404);
        }

        $result = $this->updatePaymentStatus($id);

        if (!$result['ok']) {
            return redirect(url(route('admin.orders') . '/' . $order->id))
                ->with(['fail' => $result['msg']]);
        }

        return redirect(url(route('admin.orders') . '/' . $order->id))
            ->with(['message' => 'Payment status updated successfully.']);
    }

    public function generateOrderId()
    {
        $order_id = 'ORDER' . rand(111111111111111, 999999999999999);

        if (Order::where('order_id', $order_id)->exists()) {
            return $this->generateOrderId();
        }

        return $order_id;
    }

    public function updatePaymentStatus($id)
    {
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return [
                'ok' => false,
                'msg' => 'order does not exist'
            ];
        }

        if ($order->payment_method != 'paytm') {
            return [
                'ok' => false,
                'msg' => 'cannot check payment status for order not paid using paytm'
            ];
        }

        if ($order->payment_status == 'paid') {
            return [
                'ok' => false,
                'msg' => 'skipped because payment already paid'
            ];
        }

        if ($order->payment_status == 'refunded') {
            return [
                'ok' => false,
                'msg' => 'skipped because payment already refunded'
            ];
        }

        $paytmParams = array();

        $paytmParams["body"] = array(
            "mid"           => env('PAYTM_MERCHANT_ID'),
            "orderId"       => $order->order_id,
        );

        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), env('PAYTM_MERCHANT_KEY'));

        $paytmParams["head"] = array(
            "signature" => $checksum
        );

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

        if (env('PAYTM_ENVIRONMENT') == 'production') {
            $url = "https://securegw.paytm.in/v3/order/status";
        } else {
            $url = "https://securegw-stage.paytm.in/v3/order/status";
        }


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = json_decode(curl_exec($ch));

        if (is_null($response)) {
            return [
                'ok' => false,
                'msg' => 'failed, make sure order id is correct.',
            ];
        }

        if ($response->body->resultInfo->resultStatus == 'TXN_SUCCESS') {
            $order->update([
                'payment_status' => 'paid',
                'txn_id' => $response->body->txnId,
            ]);

            return [
                'ok' => true,
            ];
        }

        if ($response->body->resultInfo->resultStatus == 'TXN_FAILURE') {
            if (!property_exists($response->body, 'txnId')) {
                return [
                    'ok' => false,
                    'msg' => $response->body->resultInfo->resultMsg,
                ];
            }

            $order->update([
                'payment_status' => 'failed',
                'txn_id' => $response->body->txnId,
            ]);

            return [
                'ok' => true,
            ];
        }

        return [
            'ok' => false,
            'msg' => 'Something went wrong',
        ];
    }

    public function searchBooking($check_in_temp, $check_out_temp) {
        $available_rooms = array();
        $check_in = date('Y-m-d', strtotime($check_in_temp));
        $check_out = date('Y-m-d', strtotime($check_out_temp));
        $temp_in = date('Y-m-d', strtotime('+1 days', strtotime($check_in_temp)));
        $temp_out = date('Y-m-d', strtotime('-1 days', strtotime($check_out_temp)));
        
        $categories = RoomCategory::all();
        $categories_enabled = array();

        foreach ($categories as $category) {
            if ($category->enabled) {
                array_push($categories_enabled, $category->id);
            }
        }

        $rooms = Room::whereIn('category_id', $categories_enabled)->where('enabled', true)->get();

        foreach ($rooms as $room) {
            $bookings = Booking::where('room_id', $room->id)->where('cancelled', false);

            if (
                (is_null(
                    $bookings->where(
                        function ($booking) use ($check_in, $check_out, $temp_out, $temp_in) {
                            $booking
                                ->whereBetween('check_in', array($check_in, $temp_out))
                                ->orWhereBetween('check_out', array($temp_in, $check_out));
                        }
                    )
                        ->first()
                ))
                &&
                (is_null(
                    $bookings->where(
                        function ($booking) use ($check_in, $check_out) {
                            $booking->where('check_in', '<=', $check_in)
                                ->where('check_out', '>=', $check_out);
                        }
                    )
                        ->first()
                ))
            ) {
                array_push($available_rooms, $room->id);
            }
        };
        
        return $available_rooms;
    }

    public function searchBookingByRoomCategory($category_id, $check_in_temp, $check_out_temp) {
        $available_rooms = array();
        $check_in = date('Y-m-d', strtotime($check_in_temp));
        $check_out = date('Y-m-d', strtotime($check_out_temp));
        $temp_in = date('Y-m-d', strtotime('+1 days', strtotime($check_in_temp)));
        $temp_out = date('Y-m-d', strtotime('-1 days', strtotime($check_out_temp)));

        $category = RoomCategory::where('id', $category_id)->first();
        if (is_null($category) || !$category->enabled) {
            return $available_rooms;
        }

        $rooms = Room::where('category_id', $category_id)->where('enabled', true)->get();
        foreach ($rooms as $room) {
            $bookings = Booking::where('room_id', $room->id)->where('cancelled', false);

            if (
                (is_null(
                    $bookings->where(
                        function ($booking) use ($check_in, $check_out, $temp_out, $temp_in) {
                            $booking
                                ->whereBetween('check_in', array($check_in, $temp_out))
                                ->orWhereBetween('check_out', array($temp_in, $check_out));
                        }
                    )
                        ->first()
                ))
                &&
                (is_null(
                    $bookings->where(
                        function ($booking) use ($check_in, $check_out) {
                            $booking->where('check_in', '<=', $check_in)
                                ->where('check_out', '>=', $check_out);
                        }
                    )
                        ->first()
                ))
            ) {
                array_push($available_rooms, $room->id);
            }
        };

        return $available_rooms;
    }

    public function roomAvailable($id, $check_in_temp, $check_out_temp) {
        $check_in = date('Y-m-d', strtotime($check_in_temp));
        $check_out = date('Y-m-d', strtotime($check_out_temp));
        $temp_in = date('Y-m-d', strtotime('+1 days', strtotime($check_in_temp)));
        $temp_out = date('Y-m-d', strtotime('-1 days', strtotime($check_out_temp)));

        $room = Room::where('id', $id)->first();
        if (is_null($room)) {
            return false;
        }

        $category = RoomCategory::where('id', $room->category_id);
        if (!$category->enabled) {
            return false;
        }

        $bookings = Booking::where('room_id', $room->id)->where('cancelled', false);

        if (
            (is_null(
                $bookings->where(
                    function ($booking) use ($check_in, $check_out, $temp_out, $temp_in) {
                        $booking
                            ->whereBetween('check_in', array($check_in, $temp_out))
                            ->orWhereBetween('check_out', array($temp_in, $check_out));
                    }
                )
                    ->first()
            ))
            &&
            (is_null(
                $bookings->where(
                    function ($booking) use ($check_in, $check_out) {
                        $booking->where('check_in', '<=', $check_in)
                            ->where('check_out', '>=', $check_out);
                    }
                )
                    ->first()
            ))
        ) {
            return true;
        }
        
        return false;
    }
}
