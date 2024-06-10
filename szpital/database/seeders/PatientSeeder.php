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
            'user_id'=>6,
            'time_visit'=>14,
            'room_id'=>1
        ],
        [
            'name'=> 'Janina',
            'surname'=>'Nowacka',
            'nurse_id'=>1,
            'user_id'=>7,
            'time_visit'=>16,
            'room_id'=>1
        ],
        [
            'name'=> 'Piotr',
            'surname'=>'Kowalski',
            'nurse_id'=>1,
            'user_id'=>8,
            'time_visit'=>12,
            'room_id'=>1
        ]
    ]);
    }
}
