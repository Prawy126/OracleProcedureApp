<?php

namespace Database\Seeders;

use App\Models\Nurse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //🧟🧟
        Nurse::truncate();

        Nurse::insert([[
            'name'=> 'Anna',
            'surname'=>'Nowak',
            'number_license'=>'12s132sad1',
            'user_id'=>2
        ]]);
    }
}
