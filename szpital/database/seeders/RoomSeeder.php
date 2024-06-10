<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Room::truncate();

        Room::insert([[
            'rnumber'=>'2B',
            'rlocation'=>'Budynek A1 skrzydło B2',
            'status'=>'wolny',
            'type_room'=>'Dla pacjentów',
            'seats'=>4
        ],
        [
           'rnumber'=>'24B',
            'rlocation'=>'Budynek A1 skrzydło B2',
            'status'=>'wolna',
            'type_room'=>'Sala operacyjna',
            'seats'=>1
        ]
    ]);
    }
}
