<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
	/**
	 * The current password being used by the factory.
	 */
	protected static ?string $password;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name' => fake()->name(),
			'email' => fake()->unique()->safeEmail(),
			'email_verified_at' => now(),
			'password' => static::$password ??= Hash::make('password'),
			'remember_token' => Str::random(10),
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

	public function admin_account(): Factory
	{
		return $this->state(function () {
			return [
				'name' => 'Admin',
				'email' => 'admin@sample.com',
				'password' => Hash::make('toanpt123')
			];
		});
	}
	public function editor_account(): Factory
	{
		return $this->state(function () {
			return [
				'name' => 'Editor Test',
				'email' => 'test@sample.com',
				'password' => Hash::make('toanpt123')
			];
		});
	}
}
