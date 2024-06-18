<?php

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Procedure::truncate();
        Procedure::insert([
            [
                'TREATMENT_TYPE_ID' => 1,
                'room_id' => 2,
                'date' => '2024-06-12 15:30',
                'time' => '01:30',
                'cost' => 560,
                'status' => 1,
                'patient_id' => 1
            ],
            [
                'TREATMENT_TYPE_ID' => 2,
                'room_id' => 3,
                'date' => '2024-06-19 10:00',
                'time' => '02:00',
                'cost' => 1200,
                'status' => 1,
                'patient_id' => 2
            ],
            [
                'TREATMENT_TYPE_ID' => 3,
                'room_id' => 4,
                'date' => '2024-06-20 11:00',
                'time' => '00:45',
                'cost' => 800,
                'status' => 1,
                'patient_id' => 3
            ],
            [
                'TREATMENT_TYPE_ID' => 1,
                'room_id' => 5,
                'date' => '2024-06-15 09:30',
                'time' => '01:15',
                'cost' => 600,
                'status' => 1,
                'patient_id' => 1
            ],
            [
                'TREATMENT_TYPE_ID' => 2,
                'room_id' => 6,
                'date' => '2024-06-16 08:00',
                'time' => '01:00',
                'cost' => 1500,
                'status' => 1,
                'patient_id' => 2
            ],
            [
                'TREATMENT_TYPE_ID' => 3,
                'room_id' => 7,
                'date' => '2024-06-17 14:00',
                'time' => '00:30',
                'cost' => 700,
                'status' => 1,
                'patient_id' => 3
            ],
            [
                'TREATMENT_TYPE_ID' => 1,
                'room_id' => 8,
                'date' => '2024-06-18 10:30',
                'time' => '01:00',
                'cost' => 650,
                'status' => 1,
                'patient_id' => 1
            ]
        ]);
    }

}
