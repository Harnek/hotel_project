<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoomCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = \App\Models\RoomCategory::create([
            'name' => 'Family Deluxe Room',
            'slug' => Str::slug('Family Deluxe Room'),
            'description' => 'Top-quality services bestowed at your doorstep, presidential suite caters all your needs and is best suited for business professionals and millennials. The room is a perfect fit for all your requirements, initiating from the tiniest sugar bag to a spacious wardrobe for your suits and intricacies. The staff caters to our presidential guests on priority basis and every little desire is taken care of.',
            'price1' => '4000',
            'price2' => '4400',
            'price3' => '5600',
            'price4' => '6500',
            'adults' => '3',
            'children' => '2',
            'image' => 'room1.jpg',
        ])->id;
        
        for($i = 0; $i < 6; $i++) {
            \App\Models\Room::create([
                'category_id' => $id,
                'room_number' => 100 + $i,
                'floor' => '1',
            ]);
        }
        
        $id = \App\Models\RoomCategory::create([
            'name' => 'Twin-Deluxe Room',
            'slug' => Str::slug('Twin-Deluxe Room'),
            'description' => 'The twin-deluxe room is our contemporary space furnished with elegant interiors and modern amenities. The deluxe room features twin-luxurious bedrooms, comprising 2 king-sized beds and bathrooms, equipped with an aesthetic writing desk, gorgeous wooden carvings, and fine quality, ostentatious furniture.',
            'price1' => '3000',
            'price2' => '3300',
            'price3' => '4300',
            'price4' => '5000',
            'adults' => '2',
            'children' => '2',
            'image' => 'room2.jpg',
        ])->id;
        
        for($i = 0; $i < 6; $i++) {
            \App\Models\Room::create([
                'category_id' => $id,
                'room_number' => 200 + $i,
                'floor' => '2',
            ]);
        }
        
        $id = \App\Models\RoomCategory::create([
            'name' => 'Double Deluxe Room',
            'slug' => Str::slug('Double Deluxe Room'),
            'description' => 'Our deluxe room enwraps a heart-warming atmosphere at very affordable prices. The guests are served with all essential items and enjoy free access to high-speed internet connectivity. The Deluxe room also enables them to have a charming view of Tamil Nadu\'s beauty and serenity.',
            'price1' => '3000',
            'price2' => '3300',
            'price3' => '4300',
            'price4' => '5000',
            'adults' => '2',
            'children' => '2',
            'image' => 'room3.jpg',
        ])->id;

        for ($i = 0; $i < 19; $i++) {
            \App\Models\Room::create([
                'category_id' => $id,
                'room_number' => 300 + $i,
                'floor' => '3',
            ]);
        }

        $id = \App\Models\RoomCategory::create([
            'name' => 'Premium Room with Balcony',
            'slug' => Str::slug('Premium Room with Balcony'),
            'description' => 'Start living the dreams that have been on hold. Spacious Premium Room with one double and sofa bed. Equipped with all modern amenities, Smart-TV, Wi-Fi Internet Acess, Air-condition, Hot and Cold water with great view of the mountains.',
            'price1' => '3500',
            'price2' => '3800',
            'price3' => '4800',
            'price4' => '5500',
            'adults' => '2',
            'children' => '2',
            'image' => 'room4.jpg',
        ])->id;

        for($i = 0; $i < 2; $i++) {
            \App\Models\Room::create([
                'category_id' => $id,
                'room_number' => 400 + $i,
                'floor' => '4',
            ]);
        }
    }
}
