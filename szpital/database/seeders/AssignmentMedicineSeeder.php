<?php

namespace Database\Seeders;

use App\Models\AssignmentMedicine;
use Illuminate\Database\Seeder;


class AssignmentMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssignmentMedicine::truncate();

        AssignmentMedicine::insert([
            [
                'patient_id' => 1,
                'medicin_id' => 1,
                'dose' => 2,
                'date_start' => '2024-06-01',
                'date_end' => '2024-06-10',
                'expiration_date' => '2025-06-01',
                'availability' => true
            ],
            [
                'patient_id' => 2,
                'medicin_id' => 2,
                'dose' => 1,
                'date_start' => '2024-07-01',
                'date_end' => '2024-07-15',
                'expiration_date' => '2025-07-01',
                'availability' => true
            ],
            [
                'patient_id' => 3,
                'medicin_id' => 3,
                'dose' => 3,
                'date_start' => '2024-08-01',
                'date_end' => '2024-08-10',
                'expiration_date' => '2025-08-01',
                'availability' => false
            ],
            [
                'patient_id' => 1,
                'medicin_id' => 4,
                'dose' => 2,
                'date_start' => '2024-09-01',
                'date_end' => '2024-09-10',
                'expiration_date' => '2025-09-01',
                'availability' => true
            ],
            [
                'patient_id' => 2,
                'medicin_id' => 5,
                'dose' => 1,
                'date_start' => '2024-10-01',
                'date_end' => '2024-10-15',
                'expiration_date' => '2025-10-01',
                'availability' => true
            ],
            [
                'patient_id' => 3,
                'medicin_id' => 6,
                'dose' => 3,
                'date_start' => '2024-11-01',
                'date_end' => '2024-11-10',
                'expiration_date' => '2025-11-01',
                'availability' => false
            ]
        ]);
    }
}
