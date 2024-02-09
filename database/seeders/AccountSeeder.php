<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\User;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $accountsData = config('db.accounts');

        foreach ($accountsData as $index => $accountsData) {
            if (isset($users[$index])) {
                $newAccount = new Account();
                $newAccount->user_id = $users[$index]->id;
                $newAccount->image = $accountsData['image'];
                $newAccount->cv = $accountsData['cv'];
                $newAccount->phone = $accountsData['phone'];
                $newAccount->address = $accountsData['address'];
                $newAccount->visible = $accountsData['visible'];
                $newAccount->save();
            }

        }
    }
}
