<?php

namespace Database\Seeders;

use App\Models\room;
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

        room::truncate();

        room::insert([[
            'rnumber'=>'2B',
            'rlocation'=>'Rzeszów',
            'status'=>'wolny',
            'type_room'=>'czteroosobowy'
        ]]);
    }
}
