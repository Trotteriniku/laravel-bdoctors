<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = config('db.reviews');
        foreach ($reviews as $review) {
            $newReview = new Review();
            $newReview->name = $review['name'];
            $newReview->title = $review['title'];
            $newReview->email = $review['email'];
            $newReview->content = $review['content'];
            $newReview->account_id = $review['account_id'];
            if (isset($review['created_at'])) {
                $newReview->created_at = $review['created_at'];
            }
            $newReview->save();

            // $newReview->account()->sync($review['account_id'] ?? []);
        }
    }
}
