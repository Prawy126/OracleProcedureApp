<?php

namespace Database\Seeders;

use App\Models\TreatmentNurse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentNurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TreatmentNurse::truncate();
        TreatmentNurse::insert([[
            'nurse_id'=>1,
            'procedure_id'=>1
        ]]);
    }
}
