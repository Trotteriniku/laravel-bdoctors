<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\Sponsorship;
use App\Models\AccountSponsorship;

class AccountSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Account::all();
        $sponsosrships = Sponsorship::all();

        foreach ($accounts as $account) {
            foreach ($sponsosrships as $specialization) {
                AccountSponsorship::create([
                    'account_id' => 2,
                    'sponsorship_id' => 1,
                    'start_date' => '',
                    'end_date' => '',
                ]);
            }
        }
    }
}


