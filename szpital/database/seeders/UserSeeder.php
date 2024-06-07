<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'password' => Hash::make('haslo'),
            'account_type' => 'admin'
        ],

        [
            'login' => 'login2',
            'password' => Hash::make('haslo'),
            'account_type' => 'nurse'
        ],

        [
            'login' => 'login3',
            'password' => Hash::make('haslo'),
            'account_type' => 'doctor'
        ],
        [
            'login' => 'login4',
            'password' => Hash::make('haslo'),
            'account_type' => 'doctor'
        ],
    ]);
    }
}
