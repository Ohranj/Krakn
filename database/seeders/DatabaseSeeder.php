<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $users = [
            [
                'forename' => 'Admin',
                'surname' => 'Account',
                'email' => 'admin@krakn.com',
                'password' => Hash::make('password'),
            ],
            [
                'forename' => 'Account',
                'surname' => 'One',
                'email' => 'account-one@krakn.com',
                'password' => Hash::make('password'),
            ]
        ];

        DB::table('users')->insert($users);
    }
}
