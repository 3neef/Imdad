<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'Passw0rd!', // password
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'is_verified' => true,
            'is_admin' => true,
            'full_name' => fake()->name(),
            'identity_number' => rand(100000, 999999),
            'identity_type' => 'nid',
            'password_changed' => true,
            'mobile' => '00966' . rand(100000000 - 999999999),
            'profile_id'=>1
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
