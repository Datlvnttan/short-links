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
    public function definition(): array
    {
        $customDomain = 'mailinator.com';
        $email = fake()->unique()->safeEmail();
        return [
            'username' => fake()->userName(),
            'full_name' => fake()->name(),
            'email' => str_replace(strstr($email, '@'), '@' . $customDomain,$email),
            'date_of_birth'=>fake()->date(),
            'address'=>fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'password' => '123',
            'role'=>"user",
            'token' => strtoupper(Str::random(20)),
            'created_at'=>fake()->dateTimeBetween(),
            'status'=>fake()->boolean()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
