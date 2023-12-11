<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\PostScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'author_id',
		'title',
		'content',
	];


	/**
	 * The "booting" method of the model.
	 */
	protected static function boot(): void
	{
		parent::boot();
		static::addGlobalScope(new PostScope);
	}

	/**
	 * Relationship of users table
	 */
	public function author(): BelongsTo
	{
		return $this->belongsTo(User::class, 'author_id');
	}


	/**
	 * List all posts
	 */
	public function listPosts(?string $search_key): array
	{
		$post = Post::with('author');

		if ($search_key)
		{
		  $post->where('title','like','%'. $search_key .'%')->orWhere('content','like','%'. $search_key .'%');
		}
		$result = $post->paginate(10);
		return [
			'posts' => $result,
			'countPosts' => $result->total()
		];
	}

	/**
	 * Show post detail
	 */
	public function getPost(int $postId): Post
	{
		return Post::find($postId)->load('author');
	}
}
