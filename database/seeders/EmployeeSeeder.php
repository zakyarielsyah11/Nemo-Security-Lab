<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.test')->first();

        $employees = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@nemosecurity.id',
                'department' => 'IT',
                'position' => 'Security Analyst',
                'phone' => '081234567890',
                'created_by' => $admin->id,
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@nemosecurity.id',
                'department' => 'Penetration Testing',
                'position' => 'Pentester',
                'phone' => '081298765432',
                'created_by' => $admin->id,
            ],
            [
                'name' => 'Andi Wijaya',
                'email' => 'andi@nemosecurity.id',
                'department' => 'Forensics',
                'position' => 'Forensic Analyst',
                'phone' => '081211223344',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}