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
		$userAdmin = User::factory()->adminAccount()->has(Role::factory()->admin())->create();
		$userEditor = User::factory()->editorAccount()->has(Role::factory()->editor())->create();
		Post::factory()->count(10)->for($userAdmin)->create();
		Post::factory()->count(10)->for($userEditor)->create();
	}
}
