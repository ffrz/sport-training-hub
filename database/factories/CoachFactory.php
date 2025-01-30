<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CoachFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        $randomAge = rand(25, 40);
        $birthdate = fake()->dateTimeBetween("-$randomAge years", "-$randomAge years")->format('Y-m-d');

        return [
            'name' => fake()->firstName($gender) . ' ' . fake()->lastName($gender),
            'gender' => $gender,
            'birth_date' => $birthdate,
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'active' => fake()->randomElement([true, false]),
        ];
    }
}
