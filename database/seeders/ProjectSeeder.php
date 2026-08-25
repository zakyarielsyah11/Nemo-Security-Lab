<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectComment;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.test')->first();
        $user = User::where('email', 'user@example.test')->first();

        $project1 = Project::create([
            'name' => 'Pentest - Web Application',
            'description' => 'Security assessment for client web app.',
            'client_name' => 'PT. Maju Jaya',
            'start_date' => '2026-01-01',
            'end_date' => '2026-02-01',
            'status' => 'active',
            'created_by' => $admin->id,
        ]);

        $project2 = Project::create([
            'name' => 'Internal Network Audit',
            'description' => 'Network penetration testing.',
            'client_name' => 'Internal',
            'start_date' => '2026-03-01',
            'end_date' => '2026-03-15',
            'status' => 'completed',
            'created_by' => $user->id,
        ]);

        // Komentar contoh
        ProjectComment::create([
            'project_id' => $project1->id,
            'user_id' => $admin->id,
            'comment' => 'Target sudah diidentifikasi. Mulai scanning.',
        ]);

        ProjectComment::create([
            'project_id' => $project1->id,
            'user_id' => $user->id,
            'comment' => 'Laporan sementara sudah dibuat.',
        ]);
    }
}