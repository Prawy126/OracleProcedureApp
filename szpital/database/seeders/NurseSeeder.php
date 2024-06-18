<?php

namespace Database\Seeders;

use App\Models\Nurse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nurse::truncate();

        Nurse::insert([[
            'name'=> 'Anna',
            'surname'=>'Nowak',
            'number_license'=>'12s132sad1',
            'user_id'=>4
        ],
        [
            'name'=> 'Joanna',
            'surname'=>'Kos',
            'number_license'=>'12s13dfad1',
            'user_id'=>5
        ],
        [
            'name' => 'Elżbieta',
            'surname' => 'Zawadzka',
            'number_license' => '9a1b2c3d4e',
            'user_id' => 11
        ],
        [
            'name' => 'Monika',
            'surname' => 'Kowalczyk',
            'number_license' => '5f6g7h8i9j',
            'user_id' => 12
        ]
    ]);
    }
}
