<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::orderBy('check_in', 'ASC')->Paginate(10);
        $categories = RoomCategory::all();
        $rooms = Room::all();

        foreach ($bookings as $booking) {
            $category = $categories->where('id', $booking->category_id)->first();
            $room = $rooms->where('id', $booking->room_id)->first();
            
            $booking->category = $category->name;
            $booking->room_number = $room->room_number;
            $booking->floor = $room->floor;
        }

        $customer_ids = array();
        foreach ($bookings as $booking) {
            array_push($customer_ids, $booking->customer_id);
        }

        $customers = Customer::find($customer_ids);
        foreach ($bookings as $booking) {
            $customer = $customers->where('id', $booking->customer_id)->first();
            $booking->customer = $customer->firstname . ' ' . $customer->lastname;
        };
        $data = json_decode($bookings->toJSON());

        return view('admin.booking.index')->with([
            'bookings' => $bookings,
            'start' => 10 * ($data->current_page - 1),
        ]);
    }

    public function show($id)
    {
        $booking = Booking::where('id', $id)->first();

        if (!$booking) {
            return abort(404);
        }

        $category = RoomCategory::where('id', $booking->category_id)->first();
        $customer = Customer::where('id', $booking->customer_id)->first();
        
        return view('admin.booking.view')->with([
            'booking' => $booking,
            'category' => $category,
            'customer' => $customer,
        ]);
    }

    public function old_bookings(Request $request)
    {
        $bookings = Archive::Paginate(10);
        $categories = RoomCategory::all();

        foreach ($bookings as $booking) {
            $category = $categories->where('id', $booking->category_id)->first();
            $booking->category = $category->name;
        }

        $customer_ids = array();
        foreach ($bookings as $booking) {
            array_push($customer_ids, $booking->customer_id);
        }

        $customers = Customer::find($customer_ids);
        foreach ($bookings as $booking) {
            $customer = $customers->where('id', $booking->customer_id)->first();
            $booking->customer = $customer->firstname . ' ' . $customer->lastname;
        };
        $data = json_decode($bookings->toJSON());

        return view('admin.booking.index')->with([
            'bookings' => $bookings,
            'start' => 10 * ($data->current_page - 1),
        ]);
    }
}
