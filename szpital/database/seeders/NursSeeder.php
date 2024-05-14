<?php

namespace Database\Seeders;

use App\Models\nurse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //🧟🧟
        nurse::truncate();

        nurse::insert([[
            'name'=> 'Anna',
            'surname'=>'Nowak',
            'number'=>'12s132sad1',
            'user_id'=>2
        ]]);

    }
}
