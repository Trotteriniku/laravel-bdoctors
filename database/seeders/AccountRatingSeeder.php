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

        foreach ($accounts as $account) {
            foreach ($ratings as $rating) {
                AccountRating::create([
                    'account_id' => 2,
                    'rating_id' => 1,

                ]);
            }
        }
    }
}
