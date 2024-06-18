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
        Room::insert([
            [
                'rnumber' => '2B',
                'rlocation' => 'Budynek A1 skrzydło B2',
                'status' => 'wolny',
                'type_room' => 'Dla pacjentów',
                'seats' => 4
            ],
            [
                'rnumber' => '24B',
                'rlocation' => 'Budynek A1 skrzydło B2',
                'status' => 'wolna',
                'type_room' => 'Sala operacyjna',
                'seats' => 1
            ],
            [
                'rnumber' => '3A',
                'rlocation' => 'Budynek A1 skrzydło A2',
                'status' => 'wolny',
                'type_room' => 'Dla pacjentów',
                'seats' => 2
            ],
            [
                'rnumber' => '15C',
                'rlocation' => 'Budynek A2 skrzydło C3',
                'status' => 'wolny',
                'type_room' => 'Sala operacyjna',
                'seats' => 1
            ],
            [
                'rnumber' => '5D',
                'rlocation' => 'Budynek A3 skrzydło D1',
                'status' => 'wolny',
                'type_room' => 'Dla pacjentów',
                'seats' => 3
            ],
            [
                'rnumber' => '8E',
                'rlocation' => 'Budynek A1 skrzydło E2',
                'status' => 'wolna',
                'type_room' => 'Sala operacyjna',
                'seats' => 1
            ],
            [
                'rnumber' => '10F',
                'rlocation' => 'Budynek A4 skrzydło F1',
                'status' => 'wolny',
                'type_room' => 'Sala operacyjna',
                'seats' => 1
            ],
            [
                'rnumber' => '12G',
                'rlocation' => 'Budynek A5 skrzydło G2',
                'status' => 'wolny',
                'type_room' => 'Dla pacjentów',
                'seats' => 5
            ],
            [
                'rnumber' => '20H',
                'rlocation' => 'Budynek A1 skrzydło H1',
                'status' => 'wolny',
                'type_room' => 'Sala operacyjna',
                'seats' => 1
            ]
        ]);
    }

}
