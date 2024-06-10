<?php

namespace Database\Seeders;

use App\Models\TreatmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TreatmentType::truncate();
        TreatmentType::insert([[
            'name' => 'operacja jelita',
            'description' => 'operacja jeslita',
            'recommendations_before_surgery' => 'zalecenia',
            'recommendations_after_surgery' => 'jedz oszczędnie'
        ]]);
    }
}
