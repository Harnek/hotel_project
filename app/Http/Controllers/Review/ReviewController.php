<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'name2' => 'required|max:50',
            'review' => 'required|max:500',
            'rating' => 'required|between:0,6',
        ], [
            'name2.*' => 'Enter a valid name',
            'review.*' => 'Enter a valid review',
            'rating.*' => 'Enter a valid rating',
        ]);

        $result = Review::create([
            "name" => $data['name2'],
            "review" => $data['review'],
            "review_date" => date('Y-m-d'),
            "rating" => $data['rating'],
        ]);

        if ($result) {
            return redirect(route('contact'))
                ->with(['message' => 'Your review added successfully.']);
        } else {
            return redirect(route('contact'))
                ->with(['message' => 'Failed to add review']);
        }
    }
}
