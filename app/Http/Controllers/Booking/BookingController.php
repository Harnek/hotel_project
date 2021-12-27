<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\RoomCategory;

class BookingController extends Controller
{
    public function index($slug)
    {
        $category = RoomCategory::where('slug', $slug)->first();

        return view('booking')
            ->with(['category' => $category]);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:room_categories,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|numeric|min:1',
            'guests' => 'required|numeric|min:1',
        ], [
            'check_in.*' => 'Please select a valid check-in date',
            'check_out.*' => 'Please select a valid check-out date',
            'rooms.*' => 'Please select valid number of rooms',
            'guests.*' => 'Please select valid number of guests',
        ]);

        $category_id = $data['category_id'];
        $check_in = date('Y-m-d', strtotime($data['check_in']));
        $check_out = date('Y-m-d', strtotime($data['check_out']));
        $rooms = (int) $data['rooms'];
        $guests = (int) $data['guests'];

        $available_rooms = $this->searchBookingByRoomCategory($category_id, $check_in, $check_out);

        if (count($available_rooms) >= $rooms) {

            return redirect()->route('booking.confirm')
                ->with([
                    'category_id' => $category_id,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'rooms' => $rooms,
                    'guests' => $guests,
                ]);
        }

        return back()->with(['fail' => 'Rooms not available for your dates']);
    }

    public function confirm(Request $request)
    {
        $request->session()->reflash();
        if (
            is_null(session()->get('category_id'))
            || is_null(session()->get('check_in'))
            || is_null(session()->get('check_out'))
            || is_null(session()->get('rooms'))
            || is_null(session()->get('guests'))
        ) {
            return redirect()->route('rooms')->with('fail', 'Something went wrong, please try again.');
        }

        $category = RoomCategory::where('id', session()->get('category_id'))->first();

        return view('booking_confirm')
            ->with([
                'category' => $category,
                'check_in' => session()->get('check_in'),
                'check_out' => session()->get('check_out'),
                'rooms' => session()->get('rooms'),
                'guests' => session()->get('guests'),
            ]);
    }

    public function redirectPay(Request $request)
    {   
        $data = $request->validate([
            'category_id' => 'required|exists:room_categories,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|numeric|min:1',
            'guests' => 'required|numeric|min:1',
            'price' => 'required|in:price1,price2,price3,price4'
        ]);

        return redirect()->route('payment')
            ->with([
                'category_id' => $data['category_id'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'rooms' => $data['rooms'],
                'guests' => $data['guests'],
                'price' => $data['price'],
            ]);
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
