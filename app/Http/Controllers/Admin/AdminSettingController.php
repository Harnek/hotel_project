<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        $data = array();
        $data['name'] = $settings->where('key', 'name')->pluck('value')->first();
        $data['owner'] = $settings->where('key', 'owner')->pluck('value')->first();
        $data['contact_email'] = $settings->where('key', 'contact_email')->pluck('value')->first();
        $data['tax_percentage'] = $settings->where('key', 'tax_percentage')->pluck('value')->first();
        $data['discount_percentage'] = $settings->where('key', 'discount_percentage')->pluck('value')->first();

        return view('admin.setting.index')
            ->with(['data' => $data]);
    }

    public function edit()
    {
        $settings = Setting::all();

        $data = array();
        $data['name'] = $settings->where('key', 'name')->pluck('value')->first();
        $data['owner'] = $settings->where('key', 'owner')->pluck('value')->first();
        $data['contact_email'] = $settings->where('key', 'contact_email')->pluck('value')->first();
        $data['tax_percentage'] = $settings->where('key', 'tax_percentage')->pluck('value')->first();
        $data['discount_percentage'] = $settings->where('key', 'discount_percentage')->pluck('value')->first();

        return view('admin.setting.edit')
            ->with(['data' => $data]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'owner' => 'required',
            'contact_email' => 'required|email',
            'tax_percentage' => 'required|numeric|min:0|max:100',
            'discount_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $settings = Setting::all();
        $settings->where('key', 'name')->first()->update(['value' => $data['name']]);
        $settings->where('key', 'owner')->first()->update(['value' => $data['owner']]);
        $settings->where('key', 'contact_email')->first()->update(['value' => $data['contact_email']]);
        $settings->where('key', 'tax_percentage')->first()->update(['value' => $data['tax_percentage']]);
        $settings->where('key', 'discount_percentage')->first()->update(['value' => $data['discount_percentage']]);

        return redirect(route('admin.settings'))
            ->with(['message' => 'Settings updated successfully.']);
    }
}
