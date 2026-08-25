<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.test')->first();
        $user = User::where('email', 'user@example.test')->first();

        $clients = [
            [
                'name' => 'PT. Maju Jaya',
                'email' => 'info@majujaya.co.id',
                'phone' => '021-123456',
                'company' => 'Maju Jaya Group',
                'address' => 'Jakarta',
                'created_by' => $admin->id,
            ],
            [
                'name' => 'PT. Sejahtera Abadi',
                'email' => 'contact@sejahtera.co.id',
                'phone' => '021-654321',
                'company' => 'Sejahtera Abadi',
                'address' => 'Bandung',
                'created_by' => $user->id,
            ],
            [
                'name' => 'PT. Global Teknologi',
                'email' => 'hello@globaltech.co.id',
                'phone' => '021-111222',
                'company' => 'Global Teknologi',
                'address' => 'Surabaya',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}