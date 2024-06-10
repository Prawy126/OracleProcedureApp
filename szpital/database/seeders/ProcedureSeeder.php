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
        //
        Procedure::truncate();
        Procedure::insert([[
            'TREATMENT_TYPE_ID'=>1,
            'room_id' => 2,
            'date' => '2024-06-12 15:30',
            'time' => '01:30',
            'cost' => 560,
            'status' => 1
        ]]);
    }
}
