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
            'room_id' => 1,
            'date' => '2024-06-12 15:30',
            'time' => '02:30',
            'cost' => 213,
            'status' => 1
        ]]);
    }
}
