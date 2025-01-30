<?php

namespace Database\Seeders;

use App\Models\Coach;
use Illuminate\Database\Seeder;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coach::factory(5)->create([
            'active' => true,
        ]);
    }
}
