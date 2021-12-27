<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('cancelled', false)->get();
        $bookings_current = 0;
        foreach ($bookings as $booking) {
            if (
                strtotime($booking->check_in) <= strtotime(date('Y-m-d'))
                && strtotime($booking->check_out) >= strtotime(date('Y-m-d'))
            ) {
                $bookings_current += 1;
            }
        }

        $tax_percentage = (float) Setting::where('key', 'tax_percentage')->pluck('value')->first();
        $discount_percentage = (float) Setting::where('key', 'discount_percentage')->pluck('value')->first();

        if (is_null($tax_percentage) || is_null($discount_percentage)) {
            return abort(500);
        }

        $reviews = Review::where('enabled', true)->get();

        $reviews_num = count($reviews);
        $rating_sum = 0;
        foreach ($reviews as $review) {
            $rating_sum += $review->rating;
        }

        $avg_rating = 0;
        if ($reviews_num > 0) {
            $avg_rating = round((float) $rating_sum / $reviews_num, 1);
        }

        return view('admin.index')
            ->with(['bookings_count' => count($bookings)])
            ->with(['bookings_current' => $bookings_current])
            ->with(['discount_percentage' => $discount_percentage])
            ->with(['tax_percentage' => $tax_percentage])
            ->with(['reviews_count' => count($reviews)])
            ->with(['avg_rating' => $avg_rating]);
    }
}
