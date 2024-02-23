<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\Sponsorship;
use App\Models\AccountSponsorship;
use Carbon\Carbon;

class AccountSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Account::all();
        $sponsosrships = Sponsorship::all();

        $relations = config('db.account_sponsorship');

        /*  foreach ($accounts as $account) {
            foreach ($specializations as $specialization) {
                AccountSpecialization::create([
                    'account_id' => $account->id,
                    'specialization_id' => $specialization->id,
                ]);
            }
        } */
        foreach ($relations as $relation) {
            AccountSponsorship::create([
                'account_id' => $relation['account_id'],
                'sponsorship_id' => $relation['sponsorship_id'],
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(6),
            ]);
        }
    }
}
