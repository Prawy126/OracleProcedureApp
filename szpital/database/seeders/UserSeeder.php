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
            'account_type' => 1
        ],

        [
            'login' => 'login2',
            'password' => Hash::make('1234'),
            'account_type' => 3
        ],

        [
            'login' => 'login3',
            'password' => Hash::make('1234'),
            'account_type' => 3
        ],
        [
            'login' => 'login4',
            'password' => Hash::make('1234'),
            'account_type' => 2
        ],
        [
            'login' => 'login5',
            'password' => Hash::make('1234'),
            'account_type' => 2
        ],
        [
            'login' => 'login6',
            'password' => Hash::make('1234'),
            'account_type' => 4
        ],
        [
            'login' => 'login7',
            'password' => Hash::make('1234'),
            'account_type' => 4
        ],
        [
            'login' => 'login8',
            'password' => Hash::make('1234'),
            'account_type' => 4
        ],
        [
            'login' => 'login9',
            'password' => Hash::make('1234'),
            'account_type' => 3
        ],
        [
            'login' => 'login10',
            'password' => Hash::make('1234'),
            'account_type' => 3
        ],
        [
            'login' => 'login11',
            'password' => Hash::make('1234'),
            'account_type' => 2
        ],
        [
            'login' => 'login12',
            'password' => Hash::make('1234'),
            'account_type' => 2
        ]
    ]);
    }
}
