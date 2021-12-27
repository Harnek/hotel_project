<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        return view('admin.review.index')
            ->with(['reviews' => $reviews]);
    }

    public function show($id)
    {
        $review = Review::where('id', $id)->first();

        if (!$review) {
            return abort(404);
        }

        return view('admin.review.view')
            ->with(['review' => $review]);
    }

    public function toggle($id) {
        $review = Review::where('id', $id)->first();

        if (!$review) {
            return abort(404);
        }

        $review->update(['enabled' => !$review->enabled]);

        return redirect(url(route('admin.reviews') . '/' . $review->id));
    }

    public function destroy($id)
    {
        $review = Review::where('id', $id)->first();

        if (!$review) {
            return abort(404);
        }

        $review->delete();

        return redirect(route('admin.reviews'))
            ->with(['message' => 'Review deleted successfully']);
    }
}
