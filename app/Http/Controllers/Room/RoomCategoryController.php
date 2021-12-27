<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomCategory;

class RoomCategoryController extends Controller
{
    public function index(Request $request) {
        $categories = RoomCategory::all();

        return view('rooms')
            ->with(['categories' => $categories]);
    }
}
