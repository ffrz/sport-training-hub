<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory(25)->create([
            'active' => false,
        ]);
        Student::factory(300)->create([
            'active' => true,
        ]);
    }
}
