<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Unique identifier
            [
                'name' => 'Admin',
                'email' => 'admin@example.com', // Admin email
                'password' => Hash::make('admin'), // Hash the password for security
            ]
        );
    }
}
