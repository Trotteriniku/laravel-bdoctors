<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = config('db.sponsorships');
        foreach ($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->duration = $sponsorship['duration'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->image = $sponsorship['image'];
            $newSponsorship->save();

        }
    }
}
