<?php

namespace Database\Seeders;

use App\Models\Medicin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicin::truncate();
        Medicin::insert([[
            'name' => 'Rutinoscorbin',
            'instruction' => 'Witamina',
            'warehouse_quantity' => 321,
            'drug_category' => 'przeciwbólowe',
            'drug_form' => 'tabletki',
            'price' => 23,
            'dose_unit' => 'taboletka'
        ]]);
    }
}
