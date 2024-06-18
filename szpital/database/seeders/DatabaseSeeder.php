<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoomSeeder::class,
            NurseSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            MedicinSeeder::class,
            TreatmentTypeSeeder::class,
            ProcedureSeeder::class,
            StatusSeeder::class,
            AssignmentMedicineSeeder::class,
            TreatmentDoctorSeeder::class,
            TreatmentNurseSeeder::class,
            SessionsSeeder::class,
        ]);
    }
}
