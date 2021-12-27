<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserSeeder::class]);
        $this->call([RoomCategorySeeder::class]);
        $this->call([ReviewSeeder::class]);
        \App\Models\Customer::factory(10)->create();
        $this->call([OrderSeeder::class]);
        $this->call([BookingSeeder::class]);
        $this->call([SettingSeeder::class]);
    }
}
