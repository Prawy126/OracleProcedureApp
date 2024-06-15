<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Procedure;
use App\Models\room;
use App\Models\Status;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        $this->call([
            UserSeeder::class,
            RoomSeeder::class,
            NurseSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            StatusSeeder::class,
            TreatmentTypeSeeder::class,
            ProcedureSeeder::class,
            MedicinSeeder::class
        ]);
    }
}
