<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $sample_reviews = [
            "Great hotel with a lovely spa. Room size was nice and spacious and bed really comfy. Would def come back",
            "The location is beautiful, it is inside a village and you will get that vibes throughout the day. The folks are very friendly. Mr Jordan and cook Vishal is always there for you. Food is really good. Vishal is very good chef. Near by temple (Chintamani) is a awesome place for relaxation and the view from the temple is superb.",
            "Although it doesn't look as premium from the outside, this is the best place in the nearby area to stay. In fact I had booked at Hotel Apple Park Inn and checked out midway to stay here for almost the same price. Location is great, close to Pothy's, you can walk around till late in the night for shopping or street food. The hotel also has central A/C.",
            "It's a new brand property staff is very courteous beach is just a stone throw away... Breakfast spread is awesome huge variety",
            "Staff is excellent. Room neat and clean. The diner is excellent. ",
            "Everything was fantastic from start to finish. The room was extremely comfortable and the staff so welcoming, we had a laugh with Nest in the mornings. Will definitely stay again!",
            "Our room was very clean and comfortable dev was extremly helpfull nothing was to much trouble",
        ];

        $sample_ratings = [5, 5, 5, 5, 4, 4, 4, 3, 3, 2, 1];
        $sample_enabled = [true, true, true, true, false];

        for ($i=0; $i < 20; $i++) { 
            \App\Models\Review::create([
                "name" => $faker->firstName() . ' ' . $faker->lastName(),
                "review" => $faker->randomElement($sample_reviews),
                "review_date" => date('Y-m-d'),
                "rating" => $faker->randomElement($sample_ratings),
                "enabled" => $faker->randomElement($sample_enabled),
            ]);
        }
    }
}
