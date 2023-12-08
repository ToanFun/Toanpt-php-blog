<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role_editor = Role::firstOrCreate(['name' => Role::ROLE_EDITOR]);
        $role_admin = Role::firstOrCreate(['name' => Role::ROLE_ADMIN]);

        $user = User::firstOrCreate(
            ['email' => 'admin@sample.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('toanpt'),
                'email_verified_at' => now()
            ]
        );

        $user->roles()->sync([$role_admin->id]);

        $user_editor = User::firstOrCreate(
            ['email' => 'test@sample.com'],
            [
                'name' => 'Test',
                'password' => Hash::make('toanpt'),
                'email_verified_at' => now()
            ]
        );
        $user_editor->roles()->sync([$role_editor->id]);

        // Posts
        Post::firstOrCreate(
            [
                'title' => 'First Post Seeder',
                'author_id' => $user->id
            ],
            [
                'content' => "
                    hello<br><br>
                    lo.<br><br>
                    Hello<br><br>
                    Hello."
            ]
        );
        Post::factory()->count(20)->create();

    }
}
