<?php

namespace Database\Seeders;

use App\Models\TreatmentDoctor;
use App\Models\TreatmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TreatmentDoctor::truncate();
        TreatmentDoctor::insert([[
            'doctor_id'=>1,
            'procedure_id'=>1
        ],
        [
            'doctor_id'=>2,
            'procedure_id'=>1
        ]
    ]);
    }
}
