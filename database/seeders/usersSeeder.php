<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'Pascale',
            'lastName' => 'Bandama',
            'phoneNumber' => '1234567890',
            'email' => 'pascale@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'firstName' => 'Jane',
            'lastName' => 'Doe',
            'phoneNumber' => '0987654321',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
