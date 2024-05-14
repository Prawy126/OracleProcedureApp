<?php

namespace Database\Seeders;

use App\Models\assignment_medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        assignment_medicine::truncate();
    }
}
