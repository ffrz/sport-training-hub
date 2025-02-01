<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::$defaultPassword = Hash::make('12345');

        User::factory()->create([
            'email' => 'fahmifauzirahman@gmail.com',
            'name' => 'Administrator',
            'role' => User::ROLE_ADMIN,
            'active' => true,
        ]);

        User::factory()->create([
            'email' => 'test@test.com',
            'name' => 'Tester',
            'role' => User::ROLE_ADMIN,
            'active' => true,
        ]);

        User::factory(5)->create();
    }
}
