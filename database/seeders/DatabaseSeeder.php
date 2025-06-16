<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MentorSeeder::class,
        ]);

        if (app()->environment('local')) {
            if (!User::where('email', 'peserta@example.com')->exists()) {
                User::factory()->create([
                    'username' => 'test_peserta',
                    'full_name' => 'Test Peserta',
                    'email' => 'peserta@example.com',
                    'password' => Hash::make('peserta123'),
                    'role' => 'peserta',
                ]);
            }
        }
    }
}
