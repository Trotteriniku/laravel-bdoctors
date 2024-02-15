<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\Specialization;
use App\Models\AccountSpecialization;

class AccountSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Account::all();
        $specializations = Specialization::all();
        $relations = config('db.account_specialization');

       /*  foreach ($accounts as $account) {
            foreach ($specializations as $specialization) {
                AccountSpecialization::create([
                    'account_id' => $account->id,
                    'specialization_id' => $specialization->id,
                ]);
            }
        } */
        foreach ($relations as $relation) {
            AccountSpecialization::create([
                'account_id' => $relation['account_id'],
                'specialization_id' => $relation['specialization_id'],
            ]);
        }
    }
}
