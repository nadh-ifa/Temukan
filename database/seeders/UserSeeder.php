<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'resepsionis@ub.ac.id'],
            [
                'name' => 'Resepsionis FILKOM',
                'password' => 'password123',
                'role' => 'resepsionis',
            ]
        );
    }
}