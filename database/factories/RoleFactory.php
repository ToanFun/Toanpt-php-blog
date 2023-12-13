<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
	protected $model = Role::class;
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name'=> $this->faker->name,
		];
	}
	public function admin(): Factory
	{
		return $this->state(function () {
			return [
				'name'=> 'admin',
			];
		});
	}

	public function editor(): Factory
	{
		return $this->state(function () {
			return [
				'name'=> 'editor',
			];
		});
	}
}
