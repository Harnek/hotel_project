<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use paytm\paytmchecksum\PaytmChecksum;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->reflash();
        if (
            is_null(session()->get('category_id'))
            || is_null(session()->get('check_in'))
            || is_null(session()->get('check_out'))
            || is_null(session()->get('rooms'))
            || is_null(session()->get('guests'))
            || is_null(session()->get('price'))
        ) {
            return redirect()->route('rooms')->with('fail', 'Something went wrong, please try again.');
        }

        $tax_percentage = (float) Setting::where('key', 'tax_percentage')->pluck('value')->first();
        $discount_percentage = (float) Setting::where('key', 'discount_percentage')->pluck('value')->first();
        if (is_null($tax_percentage) || is_null($discount_percentage)) {
            return redirect(route('rooms'))
                ->with(['fail' => 'Server Error. Please contact us for further assistance.']);
        }


        $category = RoomCategory::where('id', session()->get('category_id'))->first();
        $price_value = $category->{session()->get('price')};
        $days = date_diff(date_create_from_format('Y-m-d', session()->get('check_in')), date_create_from_format('Y-m-d', session()->get('check_out')));
        $amount = $days->d * ((int) $price_value) * ((int) session()->get('rooms'));

        $discount = 0;
        if ($discount_percentage > 0) {
            $discount = (((float) $amount * (float) $discount_percentage) / 100);
        }
        $amount -= $discount;

        $tax = (((float) $amount * (float) $tax_percentage) / 100);
        $total = (float) $amount + $tax;

        $prices_name = array(
            "price1" => "not included",
            "price2" => "Includes Breakfast",
            "price3" => "Includes Breakfast with lunch or dinner",
            "price4" => "Includes Full Meal Course",
        );

        return view('payment')
            ->with([
                'category' => $category,
                'check_in' => session()->get('check_in'),
                'check_out' => session()->get('check_out'),
                'rooms' => session()->get('rooms'),
                'guests' => session()->get('guests'),
                'price' => session()->get('price'),
                'price_name' => $prices_name[session()->get('price')],
                'amount' => $amount,
                'tax_percentage' => $tax_percentage,
                'discount' => $discount,
                'total' => $total,
            ]);
    }

    public function pay(Request $request)
    {
        $request->session()->reflash();
        $data = $request->validate([
            'category_id' => 'required|exists:room_categories,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|numeric|min:1',
            'guests' => 'required|numeric|min:1',
            'price' => 'required|in:price1,price2,price3,price4',
            'firstname' => 'required|max:255',
            'lastname' => 'nullable|max:255',
            'phone' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|max:5000',
        ]);

        $tax_percentage = (float) Setting::where('key', 'tax_percentage')->pluck('value')->first();
        $discount_percentage = (float) Setting::where('key', 'discount_percentage')->pluck('value')->first();
        if (is_null($tax_percentage) || is_null($discount_percentage)) {
            return redirect(route('rooms'))
                ->with(['fail' => 'Server Error. Please contact us for further assistance.']);
        }

        $price_value = RoomCategory::where('id', $data['category_id'])->select($data['price'])->pluck($data['price'])->first();

        $available_rooms = $this->searchBookingByRoomCategory($data['category_id'], $data['check_in'], $data['check_out']);

        if (count($available_rooms) < $data['rooms']) {
            return redirect(route('rooms'))
                ->with('fail', 'Booking full for your dates');
        }

        $customer = Customer::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        $days = date_diff(date_create_from_format('Y-m-d', $data['check_in']), date_create_from_format('Y-m-d', $data['check_out']));
        $amount = $days->d * ((int) $price_value) * ((int) $data['rooms']);

        $discount = 0;
        if ($discount_percentage > 0) {
            $discount = (((float) $amount * (float) $discount_percentage) / 100);
        }
        $amount -= $discount;

        $tax = (((float) $amount * (float) $tax_percentage) / 100);
        $total = (float) $amount + $tax;

        $category_id = [
            $data['category_id'] => (int) $data['rooms'],
        ];

        $order_id = $this->generateOrderId();
        $order = Order::create([
            'order_id'  => $order_id,
            'order_status'  => 'pending',
            'order_created' => date('Y-m-d'),
            'payment_method'  => 'paytm',
            'payment_status'  => 'pending',
            'currency'  => 'INR',
            'total'    => $total,

            'category_id' => $category_id,
            'check_in'  => $data['check_in'],
            'check_out' => $data['check_out'],
            'rooms'     => $data['rooms'],
            'guests'    => $data['guests'],
            'notes'     => $data['notes'] ?? null,

            'price' => $data['price'],
            'discount' => $discount,
            'tax_percentage' => $tax_percentage,
            'tax' => $tax,
            'amount'    => $amount,

            'customer_id' => $customer->id,
        ]);

        if (!$order) {
            return redirect()->route('rooms')
                ->with('fail', 'Could not place your booking order.');
        }

        $paytmParams = array();

        $paytmParams["body"] = array(
            "requestType"   => "Payment",
            "mid"           => env('PAYTM_MERCHANT_ID'),
            "websiteName"   => env('PAYTM_MERCHANT_WEBSITE'),
            "orderId"       => $order->order_id,
            "callbackUrl"   => url(route('payment.callback')),
            "txnAmount"     => array(
                "value"     => $order->total,
                "currency"  => "INR",
            ),
            "userInfo"      => array(
                "custId"    => $order->customer_id,
            ),
        );

        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), env('PAYTM_MERCHANT_KEY'));

        $paytmParams["head"] = array(
            "signature" => $checksum
        );

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

        if (env('PAYTM_ENVIRONMENT') === 'production') {
            $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=" . env('PAYTM_MERCHANT_ID') . "&orderId=" . $order->order_id;
        } else {
            $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=" . env('PAYTM_MERCHANT_ID') . "&orderId=" . $order->order_id;
        }

        
        $ch = curl_init($url);

        if ($ch === false) {
            $order->update([
                'order_status' => 'failed',
                'payment_status' => 'failed',
                'fail_msg' => 'could not initiate transaction',
            ]);

            return redirect(route('rooms'))->with(['fail' => 'Payment system down. Please try again.']);
        }

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $content = curl_exec($ch);

        if ($content === false) {
            $order->update([
                'order_status' => 'failed',
                'payment_status' => 'failed',
                'fail_msg' => 'could not initiate transaction',
            ]);

            return redirect(route('rooms'))->with(['fail' => 'System misconfiguration error.']);
        }

        $response = json_decode($content);
        
        if (is_null($response) || $response->body->resultInfo->resultStatus != 'S') {
            $order->update([
                'order_status' => 'failed',
                'payment_status' => 'failed',
                'fail_msg' => 'could not initiate transaction',
            ]);

            return redirect(route('rooms'))->with(['fail' => 'Payment system down. Please try again.']);
        }

        return view('paytm_redirect')
            ->with([
                'mid' => env('PAYTM_MERCHANT_ID'),
                'order_id' => $order->order_id,
                'txn_token' => $response->body->txnToken,
            ]);

    }

    public function callback(Request $request)
    {
        $data = $request->all();

        $order = Order::where('order_id', $data['ORDERID'])->first();
        // TODO: verify order amount == txnamount
        if ($order) {
            if ($data['STATUS'] == 'TXN_SUCCESS') {
                $order->update([
                    'order_status' => 'processed',
                    'payment_status' => 'paid',
                    'txn_id' => $data['TXNID'],
                ]);
            } else if ($data['STATUS'] == 'TXN_FAILURE') {
                $order->update([
                    'order_status' => 'processed',
                    'payment_status' => 'failed',
                    'txn_id' => $data['TXNID'],
                    'resp_msg' => $data['RESPMSG'],
                ]);
                return redirect()->route('rooms')
                    ->with('fail', 'Booking failed due to unsuccessful payment.');
            } else {
                $order->update([
                    'payment_status' => 'failed',
                    'order_status' => 'processed',
                    'txn_id' => $data['TXNID'],
                    'resp_msg' => $data['RESPMSG'],
                ]);
                return redirect()->route('rooms')
                    ->with('fail', 'Booking failed due to unsuccessful payment.');
            }
        } else {
            Log::alert("Unknown order id callback", $data['ORDERID']);
            return abort(404);
        }

        if ($order->payment_status == 'paid') {
            $available_rooms = array();

            foreach ($order->category_id as $category_id => $count) {
                $available_rooms[$category_id] = $this->searchBookingByRoomCategory($category_id, $order->check_in, $order->check_out);

                if (count($available_rooms[$category_id]) < (int) $count) {
                    $order->update([
                        'order_status' => 'failed',
                        'fail_msg' => 'Not enough rooms available'
                    ]);

                    return redirect()->route('rooms')
                        ->with('fail', 'Rooms not available anymore, Please ask for refund.');
                }
            }

            foreach ($order->category_id as $category_id => $count) {
                for ($i = 0; $i < (int) $count; $i++) {
                    Booking::create([
                        'room_id' => $available_rooms[$category_id][$i],
                        'category_id' => $category_id,
                        'customer_id' => $order->customer_id,
                        'order_id' => $order->id,
                        'check_in' => $order->check_in,
                        'check_out' => $order->check_out,
                        'guests' => $order->guests,
                        'notes' => $order->notes,
                    ]);
                }
            }
        }

        return redirect(url('/order' . '/' . $order->order_id));
    }

    public function generateOrderId()
    {
        $order_id = 'ORDER' . rand(111111111111111, 999999999999999);

        if (Order::where('order_id', $order_id)->exists()) {
            return $this->generateOrderId();
        }

        return $order_id;
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
