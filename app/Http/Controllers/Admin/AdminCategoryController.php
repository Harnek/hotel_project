<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = RoomCategory::all();

        return view('admin.category.index')
            ->with(['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();

        $image_name = 'placeholder_category.jpg';

        if (array_key_exists('image', $data)) {
            $image_name = time() . $data['image']->extension();
            $data['image']->move(public_path('images'), $image_name);   // store 
        }

        $enabled = false;

        if (array_key_exists('enabled', $data) && $data['enabled'] == 'on') {
            $enabled = true;
        }

        $result = RoomCategory::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'],
            'price1' => $data['price1'],
            'price2' => $data['price2'],
            'price3' => $data['price3'],
            'price4' => $data['price4'],
            'adults' => $data['adults'],
            'children' => $data['children'],
            'image' => $image_name,
            'enabled' => $enabled,
        ]);

        if ($result) {
            return redirect()->route('admin.categories')->with(["message" => 'Room Category created successfully']);
        } else {
            return redirect()->route('admin.categories')->with(["fail" => 'Room Category creation failed. Something went wrong.']);
        }
    }

    public function show($id)
    {
        $category = RoomCategory::where('id', $id)->first();
        $rooms = Room::where('category_id', $category->id)->get();

        if ($category) {
            return view('admin.category.view')
                ->with(['category' => $category])
                ->with(['rooms' => $rooms]);
        }

        abort(404);
    }

    public function edit($id)
    {
        $category = RoomCategory::where('id', $id)->first();

        if (!$category) {
            abort(404);
        }
        
        return view('admin.category.edit')
            ->with(['category' => $category]);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $category = RoomCategory::where('id', $id)->get()->first();

        $image_name = $category->image;

        if (array_key_exists('image', $data)) {
            $image_name = time() . '.' . $data['image']->extension();
            $data['image']->move(public_path('images'), $image_name);   // store 
        }

        $enabled = false;

        if (array_key_exists('enabled', $data) && $data['enabled'] == 'on') {
            $enabled = true;
        }

        $category->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'],
            'price1' => $data['price1'],
            'price2' => $data['price2'],
            'price3' => $data['price3'],
            'price4' => $data['price4'],
            'adults' => $data['adults'],
            'children' => $data['children'],
            'image' => $image_name,
            'enabled' => $enabled,
        ]);

        if ($category) {
            return redirect(url(route('admin.categories') . '/' . $id))->with(["message" => 'Room Category updated successfully']);
        } else {
            return redirect(url(route('admin.categories') . '/' . $id))->with(["fail" => 'Room Category update failed. Something went wrong.']);
        }
    }
}
