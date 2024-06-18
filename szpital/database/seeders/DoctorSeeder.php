<?php

namespace Database\Seeders;

use App\Models\doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        doctor::truncate();
        doctor::insert([[
            'name' => 'Adam',
            'surname'=> 'Kowal',
            'specialization'=>'chirurg',
            'license_number' => 'A231B312S',
            'user_id' => 2
        ],
        [
           'name' => 'Jan',
            'surname'=> 'Kowalsli',
            'specialization'=>'chirurg',
            'license_number' => 'A231B3FDS',
            'user_id' => 3
        ],
        [
            'name' => 'Michał',
            'surname' => 'Nowak',
            'specialization' => 'kardiolog',
            'license_number' => 'B123C456D',
            'user_id' => 9
        ],
        [
            'name' => 'Anna',
            'surname' => 'Wiśniewska',
            'specialization' => 'internista',
            'license_number' => 'C789D012E',
            'user_id' => 10
        ]

    ]);
    }
}
