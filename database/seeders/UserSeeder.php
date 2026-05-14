<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@rukenya.co.ke',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // MANAGER
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@rukenya.co.ke',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        // MEMBER 1
        User::create([
            'name' => 'John Member',
            'email' => 'member1@rukenya.co.ke',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);

        // MEMBER 2
        User::create([
            'name' => 'Jane Member',
            'email' => 'member2@rukenya.co.ke',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);
    }
}