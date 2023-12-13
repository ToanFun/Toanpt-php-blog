<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\PostScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Helpers\Constants\PostConstant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Pagination\Paginator;

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
	public function listPosts(array $search_keys): array
	{
		$post = Post::with('author');
		if (isset($search_keys['key']))
		{
		  $post->where('title','like','%'. $search_keys['key'] .'%')->orWhere('content','like','%'. $search_keys['key'] .'%');
		}
		$result = $post->paginate(PostConstant::POSTS_PER_PAGE_LIMIT);
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
		return Post::with('author')->findOrFail($postId);
	}

	/**
	 * Count newest posts in week
	 */
	public function countNewestPostsInWeek(): int
	{
		return Post::whereBetween('updated_at', [parseTextToDate('1 week ago'), now()])->count();
	}

	/**
	 * List posts by admin
	 */
	public function ListAllPosts(): Paginator
	{
		return Post::with('author')->paginate(PostConstant::POSTS_PER_ADMIN_PAGE_LIMIT);
	}

	/**
	 * Update post
	 */

	public function updatePost(int $postId, array $attributes): Post
	{
		$post = Post::find($postId);
		if (!$post) {
			throw new ModelNotFoundException('');
		}
		$post->fill($attributes);
		$post->save();
		return $post->fresh();
	}

	/**
	 * Create post
	 */
	public function createPost(array $attributes): Post|null
	{
		return Post::create($attributes);
	}

	/**
	 * Delete post
	 */
	public function deletePost(int $postId): int
	{
		$post = Post::find($postId);
		if (!$post) {
			throw new ModelNotFoundException('');
		}
		return $post->delete();
	}
}
