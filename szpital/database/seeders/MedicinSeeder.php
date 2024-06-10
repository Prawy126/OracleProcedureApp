<?php

namespace Database\Seeders;

use App\Models\medicin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        medicin::truncate();
    }
}
