<?php

namespace Database\Seeders;

use App\Models\treatments_nurse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentsNurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        treatments_nurse::truncate();
    }
}
