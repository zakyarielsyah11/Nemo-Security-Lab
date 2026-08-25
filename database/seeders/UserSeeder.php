<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Nemo',
            'email' => 'admin@example.test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'department' => 'Security Operations',
            'position' => 'Security Manager',
            'phone' => '081234567890',
            'address' => 'Jakarta',
            'is_active' => true,
        ]);

        // Regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.test',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'department' => 'IT',
            'position' => 'Security Analyst',
            'phone' => '081298765432',
            'address' => 'Jakarta',
            'is_active' => true,
        ]);

        // Additional users
        $testUsers = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.test',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'department' => 'Penetration Testing',
                'position' => 'Pentester',
                'phone' => '081111111111',
                'address' => 'Bandung',
                'is_active' => true,
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.test',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'department' => 'Forensics',
                'position' => 'Forensic Analyst',
                'phone' => '081222222222',
                'address' => 'Surabaya',
                'is_active' => true,
            ],
            [
                'name' => 'Charlie Brown',
                'email' => 'charlie@example.test',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'department' => 'Compliance',
                'position' => 'Auditor',
                'phone' => '081333333333',
                'address' => 'Yogyakarta',
                'is_active' => true,
            ],
        ];

        foreach ($testUsers as $user) {
            User::create($user);
        }
    }
}