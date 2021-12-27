<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 15; $i++) {

            $category = \App\Models\RoomCategory::inRandomOrder()->get()->first();
            $customer = \App\Models\Customer::inRandomOrder()->get()->first();
            
            $statuses = [
                ['processed', 'paid'], 
                ['processed', 'paid'], 
                ['processed', 'paid'], 
                ['processed', 'paid'], 
                ['processed', 'paid'], 
                ['processed', 'paid'], 
                ['processed', 'paid'], 
                ['processed', 'pending'], 
                ['cancelled', 'paid'],
                ['cancelled', 'paid'],
                ['failed', 'paid'],
                ['failed', 'failed'],
            ];

            $status = $statuses[array_rand($statuses)];
            $order_status = $status[0];
            $payment_status = $status[1];

            $prices = ['price1', 'price2', 'price3', 'price4'];
            $price = $prices[array_rand($prices)];
            $num_rooms = [1, 1, 1, 1, 1, 1, 2, 2, 3];
            $rooms = $num_rooms[array_rand($num_rooms)];
            $num_guests = [1, 1, 1, 2, 2, 2, 3, 3, 4];
            $guests = $num_guests[array_rand($num_guests)];

            $temp_date = date('Y-m-d', strtotime('next week'));
            $check_in = $this->randomDate(date('Y-m-d'), $temp_date);

            $temp_date = date('Y-m-d', strtotime('+5 days', strtotime($check_in)));
            $check_out = $this->randomDate(
                date('Y-m-d', strtotime("+1 day", strtotime($check_in))), 
                $temp_date
            );
            $days = date_diff(date_create_from_format('Y-m-d', $check_in), date_create_from_format('Y-m-d', $check_out));
            $amount = $days->d * ((int) $category->{$price}) * $rooms;
            $tax_percentage = (int) config('HOTEL_TAX', 12);
            $tax = (((float) $amount * (float) $tax_percentage) / 100);
            $total = (float) $amount + $tax;
            
            $category_id = [
                $category->id => $rooms,
            ];

            $payment_method = 'paytm';
            if ($payment_status == 'pending' && $order_status == 'processed') {
                $payment_method = 'cash';
            }

            \App\Models\Order::create([
                'order_id'  => $this->generateOrderId(),
                'payment_method'  => $payment_method,
                'payment_status'  => $payment_status,
                'order_status'  => $order_status,
                'order_created' => date('Y-m-d'),
                'currency'  => 'INR',
                'total'    => $total,
                
                'category_id' => $category_id,
                'check_in'  => $check_in,
                'check_out' => $check_out,
                'rooms'     => $rooms,
                'guests'    => $guests,
                'price' => $price,
                'discount' => '0',
                'tax_percentage' => $tax_percentage,
                'tax' => $tax,
                'amount' => $amount,
                'total' => $total,
                'customer_id' => $customer->id,
            ]);
        }
    }

    public function generateOrderId()
    {
        $order_id = 'ORDER' . rand(111111111111111, 999999999999999);

        if (\App\Models\Order::where('order_id', $order_id)->exists()) {
            return $this->generateOrderId();
        }

        return $order_id;
    }

    function randomDate($start_date, $end_date)
    {
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        $val = rand($min, $max);

        return date('Y-m-d', $val);
    }
}


