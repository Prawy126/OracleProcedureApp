<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Status::truncate();
        Status::insert([[
            'status'=>1,
            'description'=> "Oczekuje na ropoczęcie"
        ],
        [
            'status'=>2,
            'description'=> "Zabieg trwa"
        ],
        [
            'status'=>3,
            'description'=> "Zabieg zakończony"
        ]
    ]);
    }
}
