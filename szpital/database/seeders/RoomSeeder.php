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
            'rlocation'=>'Rzeszów',
            'status'=>'wolny',
            'type_room'=>'czteroosobowy',
            'seats'=>1
        ]]);
    }
}
