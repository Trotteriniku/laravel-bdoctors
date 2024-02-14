<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = config('db.ratings');
        foreach ($ratings as $rating) {
            $newRating = new Rating();
            $newRating->value = $rating['value'];
            $newRating->save();
        }


    }
}
