<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomCategory;

class AdminRoomController extends Controller
{
    public function index()
    {
        $categories_temp = RoomCategory::all(['id', 'name']);
        $categories = array();

        foreach ($categories_temp as $temp) {
            $categories[$temp->id] = $temp->name;
        }

        $rooms = Room::orderBy('category_id', 'ASC')->get();
        foreach ($rooms as $room) {
            $room->category_name = $categories[$room->category_id];
        };

        return view('admin.room.index')
            ->with(
                [
                    'rooms' => $rooms,
                ]
            );
    }

    public function create()
    {
        $categories_query = RoomCategory::select(['id', 'name'])->get();

        $categories = array();
        foreach ($categories_query as $category) {
            $categories[$category->id] = $category->name;
        };

        return view('admin.room.create')->with(['categories' => $categories]);
    }

    public function store(RoomStoreRequest $request)
    {
        $data = $request->validated();
        $enabled = false;

        if (array_key_exists('enabled', $data) && $data['enabled'] == 'on') {
            $enabled = true;
        }

        $result = Room::create([
            'category_id' => $data['category_id'],
            'room_number' => $data['room_number'],
            'floor' => $data['floor'],
            'enabled' => $enabled,
        ]);

        if ($result) {
            return redirect()->route('admin.rooms')->with(["message" => 'Room created successfully']);
        } else {
            return redirect()->route('admin.rooms')->with(["fail" => "Room creation failed. Something went wrong."]);
        }
    }

    public function show($id)
    {
        $room = Room::where('id', $id)->first();
        $bookings = Booking::where('room_id', $room->id)->get();
        
        $customer_ids = array();
        foreach ($bookings as $booking) {
            array_push($customer_ids, $booking->customer_id);
        }

        $customers = Customer::find($customer_ids);
        foreach ($bookings as $booking) {
            $customer = $customers->where('id', $booking->customer_id)->first();
            $booking->customer = $customer->firstname . ' ' . $customer->lastname;
        };

        if ($room) {
            $room->category = RoomCategory::select(['name'])->where('id', $room->category_id)->first()->name;
            return view('admin.room.view')
                ->with(['room' => $room])
                ->with(['bookings' => $bookings]);
        }

        abort(404);
    }

    public function edit($id)
    {
        $room = Room::where('id', $id)->first();

        if ($room) {
            $categories_query = RoomCategory::select(['id', 'name'])->get();

            $categories = array();
            foreach ($categories_query as $category) {
                $categories[$category->id] = $category->name;
            };

            return view('admin.room.edit')
                ->with(['categories' => $categories, 'room' => $room]);
        }

        abort(404);
    }

    public function update(RoomUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $enabled = false;

        if (array_key_exists('enabled', $data) && $data['enabled'] == 'on') {
            $enabled = true;
        }

        $result = Room::where('id', $id)->update([
            'category_id' => $data['category_id'],
            'room_number' => $data['room_number'],
            'floor' => $data['floor'],
            'enabled' => $enabled,
        ]);

        if ($result) {
            return redirect()->route('admin.rooms')->with(["message" => 'Room updated successfully']);
        } else {
            return redirect()->route('admin.rooms')->with(["fail" => "Room update failed. Something went wrong."]);
        }
    }

    public function destroy($id)
    {
    }
}
