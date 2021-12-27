<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create(['key' => 'name', 'value' => 'Hotel Sunshine']);
        \App\Models\Setting::create(['key' => 'owner', 'value' => 'John Doe']);
        \App\Models\Setting::create(['key' => 'contact_email', 'value' => 'contact@sunshinehotel.com']);
        \App\Models\Setting::create(['key' => 'tax_percentage', 'value' => '12']);
        \App\Models\Setting::create(['key' => 'discount_percentage', 'value' => '0']);
    }
}
