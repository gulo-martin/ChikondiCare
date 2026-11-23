<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $name = 'admin';
        $email = "admin@example.com";
        $password = "admin123";

        if (!$name || !$email || !$password) {
            throw new RuntimeException(
                'Set ADMIN_NAME, ADMIN_EMAIL and ADMIN_PASSWORD in your seeder file.'
            );
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
            ]
        );

        $this->command->info('ChikondiCare administrator account created.');
    }
}
