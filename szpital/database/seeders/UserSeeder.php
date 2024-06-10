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
            'password' => Hash::make('1234'),
            'account_type' => 'admin'
        ],

        [
            'login' => 'login2',
            'password' => Hash::make('1234'),
            'account_type' => 'doctor'
        ],

        [
            'login' => 'login3',
            'password' => Hash::make('1234'),
            'account_type' => 'doctor'
        ],
        [
            'login' => 'login4',
            'password' => Hash::make('1234'),
            'account_type' => 'nurse'
        ],
        [
            'login' => 'login5',
            'password' => Hash::make('1234'),
            'account_type' => 'nurse'
        ],
        [
            'login' => 'login6',
            'password' => Hash::make('1234'),
            'account_type' => 'patient'
        ],
        [
            'login' => 'login7',
            'password' => Hash::make('1234'),
            'account_type' => 'patient'
        ],
        [
            'login' => 'login8',
            'password' => Hash::make('1234'),
            'account_type' => 'patient'
        ],
    ]);
    }
}
