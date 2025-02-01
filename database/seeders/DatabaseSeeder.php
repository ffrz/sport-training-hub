<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('student_groups')->insert([
                [
                    'name' => 'U12 Putra',
                ],
                [
                    'name' => 'U12 Putri',
                ],
                [
                    'name' => 'U14 Putra',
                ],
                [
                    'name' => 'U14 Putri',
                ],
            ]);

            $this->call([
                UserSeeder::class,
                CoachSeeder::class,
                StudentSeeder::class,
            ]);
        });
    }
}
