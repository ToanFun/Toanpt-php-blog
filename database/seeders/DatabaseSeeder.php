<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$user_admin = User::factory()->admin_account()->has(Role::factory()->admin())->create();
		$user_editor = User::factory()->editor_account()->has(Role::factory()->editor())->create();
		Post::factory()->count(10)->for($user_admin)->create();
		Post::factory()->count(10)->for($user_editor)->create();
	}
}
