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
        User::factory(20)->create();
        User::factory(1)->create([
            'email' => 'fahmifauzirahman@gmail.com',
            'name' => 'Administrator',
            'role' => User::ROLE_ADMIN,
            'active' => true,
        ]);
    }
}
