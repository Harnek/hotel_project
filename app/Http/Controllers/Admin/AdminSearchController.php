<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminSearchController extends Controller
{
    public function search(Request $request)
    {
        $rooms_ids = [];
        $check_in = null;
        $check_out = null;
        $category_id = null;
        
        if ($request->has('check_in') && $request->has('check_out')) {
            $data = $request->validate([
                'check_in' => 'required|date|after_or_equal:today',
                'check_out' => 'required|date|after:check_in',
            ], [
                'check_in.*' => 'Please select a valid check-in date',
                'check_out.*' => 'Please select a valid check-out date',
            ]);
            
            $check_in = $data['check_in'];
            $check_out = $data['check_out'];
            
            if ($request->has('category_id') && $request->input('category_id') != 'all') {
                $date_temp = $request->validate([
                    'category_id' => 'required|exists:room_categories,id',
                ]);
                $category_id = $date_temp['category_id'];
                $rooms_ids = $this->searchBookingByRoomCategory($category_id, $check_in, $check_out);
            } else {
                $rooms_ids = $this->searchBooking($check_in, $check_out);
            }
        } else {
            $check_in = date('Y-m-d');
            $check_out = date('Y-m-d', strtotime('tomorrow'));
            $rooms_ids = $this->searchBooking($check_in, $check_out);
        }
        
        $categories = RoomCategory::all();
        $rooms = Room::findMany($rooms_ids);
        
        foreach ($rooms as $room) {
            $room->category_name = $categories->where('id', $room->category_id)->pluck('name')->first();
        };

        return view('admin.search.index')
            ->with(['check_in' => $check_in])
            ->with(['check_out' => $check_out])
            ->with(['category_id' => $category_id])
            ->with(['categories' => $categories])
            ->with(['rooms' => $rooms]);
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
