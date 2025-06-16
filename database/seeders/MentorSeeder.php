<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MentorSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'mentor@example.com')->exists()) {
            User::create([
                'username' => 'admin_mentor',
                'full_name' => 'Admin Mentor',
                'email' => 'mentor@example.com',
                'password' => Hash::make('mentor123'),
                'role' => 'mentor',
            ]);
        }
    }
}
