<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Account;
use App\Models\AccountRating;

class AccountRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Account::all();
        $ratings = Rating::all();
        $relations = config('db.account_rating');

        foreach ($relations as $relation) {
            if (isset($relation['created_at'])) {
                AccountRating::create([
                    'account_id' => $relation['account_id'],
                    'rating_id' => $relation['rating_id'],
                    'created_at' => $relation['created_at'],
                ]);
            } else {
                AccountRating::create([
                    'account_id' => $relation['account_id'],
                    'rating_id' => $relation['rating_id'],
                ]);
            }
        }
    }
}
