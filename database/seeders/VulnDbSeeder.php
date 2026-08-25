<?php

namespace Database\Seeders;

use App\Models\VulnDb;
use App\Models\User;
use Illuminate\Database\Seeder;

class VulnDbSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.test')->first();

        $vulns = [
            [
                'name' => 'SQL Injection',
                'description' => 'Injection flaw allowing SQL manipulation.',
                'severity' => 'high',
                'category' => 'Injection',
                'remediation' => 'Use parameterized queries and ORM.',
                'created_by' => $admin->id,
            ],
            [
                'name' => 'Cross-Site Scripting (XSS)',
                'description' => 'Client-side code injection.',
                'severity' => 'medium',
                'category' => 'Injection',
                'remediation' => 'Sanitize and encode output.',
                'created_by' => $admin->id,
            ],
            [
                'name' => 'Broken Access Control',
                'description' => 'Privilege escalation through IDOR.',
                'severity' => 'high',
                'category' => 'Access Control',
                'remediation' => 'Implement server-side authorization checks.',
                'created_by' => $admin->id,
            ],
            [
                'name' => 'Command Injection',
                'description' => 'OS command injection via input.',
                'severity' => 'critical',
                'category' => 'Injection',
                'remediation' => 'Avoid shell commands; use APIs.',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($vulns as $vuln) {
            VulnDb::create($vuln);
        }
    }
}