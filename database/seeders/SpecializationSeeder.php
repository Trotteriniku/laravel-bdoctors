<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = config('db.specializations');
        foreach ($specializations as $specialization) {
            $newSpecialization = new Specialization();
            $newSpecialization->name = $specialization['name'];
            $newSpecialization->save();
        }
    }
}
