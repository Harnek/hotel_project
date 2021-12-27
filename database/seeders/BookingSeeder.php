<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = \App\Models\Order::all();
        foreach($orders as $order) {
            if ($order->order_status != 'failed' && ($order->payment_status == 'paid' || $order->payment_status == 'pending')) {
                foreach($order->category_id as $category_id => $count) { 
                    for ($i=0; $i < $count; $i++) { 
                        $category = \App\Models\RoomCategory::where('id', $category_id)->first();
                        $room = \App\Models\Room::where('category_id', $category->id)->inRandomOrder()->get()->first();
                        \App\Models\Booking::create([
                            'room_id' => $room->id,
                            'category_id' => $category->id,
                            'customer_id' => $order->customer_id,
                            'order_id' => $order->id,
                            'check_in' => $order->check_in,
                            'check_out' => $order->check_out,
                            'guests' => $order->guests,
                            'notes' => $order->notes,
                            'cancelled' => $order->order_status == 'cancelled',
                        ]);

                    }
                }
            }
        }
    }
}
