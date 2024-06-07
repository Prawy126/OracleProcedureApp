<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::truncate();
        Patient::insert([[
            'name'=> 'Anna',
            'surname'=>'Nowak',
            'nurse_id'=>1,
            'user_id'=>4,
            'time_visit'=>32,
            'room_id'=>1
        ]]);
    }
}
