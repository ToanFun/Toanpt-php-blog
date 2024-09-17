<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Helpers\Constants\PostConstant;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
	];

	/**
	 * Show relationship with posts table
	 */
	public function posts(): HasMany
	{
		return $this->hasMany(Post::class, 'author_id');
	}

	/**
	 * Show relationship with roles table
	 */
	public function roles(): BelongsToMany
	{
		return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
	}

	/**
	 * Get all detail of user
	 */
	public function getInfo(int $userId): array
	{
		$user = User::with('posts')->findOrFail($userId);
		return [
			'user' => $user,
			'posts_count' => $user->posts()->count(),
			'posts' => $user->posts()->limit(PostConstant::POSTS_SHOWING_IN_USER_DETAIL_LIMIT)->get()
		];
	}
}
