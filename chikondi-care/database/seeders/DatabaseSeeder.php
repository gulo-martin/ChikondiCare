<?php

namespace Database\Seeders;

use App\Models\ConsultationFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminUserSeeder::class);

        ConsultationFee::query()->firstOrCreate(
            ['name' => 'General consultation'],
            ['amount' => 5000, 'is_active' => true]
        );
    }
}
