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
            'name' => 'test',
            'description' => 'Losowy ciąg znaków',
            'recommendations_before_surgery' => 'Jakieś zalecenia',
            'recommendations_after_surgery' => 'Może będzie dobrze'
        ]]);
    }
}
