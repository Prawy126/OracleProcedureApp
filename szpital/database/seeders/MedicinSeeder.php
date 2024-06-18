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
        Medicin::insert([
            [
                'name' => 'Rutinoscorbin',
                'instruction' => 'Witamina',
                'warehouse_quantity' => 321,
                'drug_category' => 'przeciwbólowe',
                'drug_form' => 'tabletki',
                'price' => 23,
                'dose_unit' => 'tabletka'
            ],
            [
                'name' => 'Ibuprofen',
                'instruction' => 'Przeciwbólowy i przeciwzapalny',
                'warehouse_quantity' => 450,
                'drug_category' => 'przeciwbólowe',
                'drug_form' => 'tabletki',
                'price' => 15,
                'dose_unit' => 'tabletka'
            ],
            [
                'name' => 'Paracetamol',
                'instruction' => 'Środek przeciwbólowy',
                'warehouse_quantity' => 500,
                'drug_category' => 'przeciwbólowe',
                'drug_form' => 'tabletki',
                'price' => 12,
                'dose_unit' => 'tabletka'
            ],
            [
                'name' => 'Amoxicillin',
                'instruction' => 'Antybiotyk',
                'warehouse_quantity' => 200,
                'drug_category' => 'antybiotyki',
                'drug_form' => 'kapsułki',
                'price' => 40,
                'dose_unit' => 'kapsułka'
            ],
            [
                'name' => 'Cetirizine',
                'instruction' => 'Lek przeciwhistaminowy',
                'warehouse_quantity' => 350,
                'drug_category' => 'przeciwhistaminowe',
                'drug_form' => 'tabletki',
                'price' => 18,
                'dose_unit' => 'tabletka'
            ],
            [
                'name' => 'Omeprazole',
                'instruction' => 'Lek na wrzody i refluks',
                'warehouse_quantity' => 275,
                'drug_category' => 'leki na wrzody',
                'drug_form' => 'kapsułki',
                'price' => 30,
                'dose_unit' => 'kapsułka'
            ],
            [
                'name' => 'Aspirin',
                'instruction' => 'Środek przeciwbólowy i przeciwzapalny',
                'warehouse_quantity' => 400,
                'drug_category' => 'przeciwbólowe',
                'drug_form' => 'tabletki',
                'price' => 20,
                'dose_unit' => 'tabletka'
            ],
            [
                'name' => 'Loratadine',
                'instruction' => 'Lek przeciwhistaminowy',
                'warehouse_quantity' => 300,
                'drug_category' => 'przeciwhistaminowe',
                'drug_form' => 'tabletki',
                'price' => 25,
                'dose_unit' => 'tabletka'
            ],
            [
                'name' => 'Metformin',
                'instruction' => 'Lek na cukrzycę',
                'warehouse_quantity' => 150,
                'drug_category' => 'leki na cukrzycę',
                'drug_form' => 'tabletki',
                'price' => 35,
                'dose_unit' => 'tabletka'
            ]
        ]);
    }

}
