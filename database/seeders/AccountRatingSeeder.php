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

        /*  foreach ($accounts as $account) {
            foreach ($specializations as $specialization) {
                AccountSpecialization::create([
                    'account_id' => $account->id,
                    'specialization_id' => $specialization->id,
                ]);
            }
        } */
        foreach ($relations as $relation) {
            AccountRating::create([
                'account_id' => $relation['account_id'],
                'rating_id' => $relation['rating_id'],
            ]);
        }

        // foreach ($accounts as $account) {
        //     foreach ($ratings as $rating) {
        //         AccountRating::create([
        //             'account_id' => 2,
        //             'rating_id' => 1,
        //         ]);
        //     }
        // }
    }
}
