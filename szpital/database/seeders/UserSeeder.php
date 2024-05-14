<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::truncate();

        User::insert([[
            'login' => 'login',
            'password' => 'haslo',
            'account_type' => 'patient'
        ],

        [
            'login' => 'login2',
            'password' => 'haslo',
            'account_type' => 'nurse'
        ],

        [
            'login' => 'login3',
            'password' => 'haslo',
            'account_type' => 'doctor'
        ]
    ]);
    }
}
