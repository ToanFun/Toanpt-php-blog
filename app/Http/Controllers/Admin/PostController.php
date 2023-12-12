<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	protected Post $post;
	protected User $user;
	public function __construct(Post $post, User $user)
	{
		$this->post = $post;
		$this->user = $user;
	}
	/**
	 * Show the application posts index.
	 */
	public function index(): View
	{
		return view('admin.posts.index', [
			'posts' => $this->post->ListAllPosts(),
		]);
	}

	/**
	 * Display the specified resource edit form.
	 */
	public function edit(int $postId): View
	{
		$post = $this->post->getPost($postId);
		$userIds = array_unique(array_filter([$post->author->id, $post->author->admin_id, Auth::id()]));
		$users = $this->user->getAuthors($userIds);
		return view('admin.posts.edit', [
			'post' => $post,
			'users' => $users,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Request $request): View
	{
		$userIds = array_filter([Auth::id(), Auth::user()->admin_id]);
		$users = $this->user->getAuthors($userIds);
		return view('admin.posts.create', [
			'users' => $users,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PostRequest $request): RedirectResponse
	{
		$postParams = $request->only(['title', 'content', 'author_id']);

		$post = $this->post->createPost($postParams);
		if (! $post) {
			return redirect()->route('admin.posts.create')->withErrors(__('posts.created_failed'));
		}
		return redirect()->route('admin.posts.edit', $post->id)->withSuccess(__('posts.created'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(PostRequest $request, int $postId): RedirectResponse
	{
		$updateParams = $request->only(['title', 'content']);
		$post = $this->post->updatePost($postId, $updateParams);
		if (!$post) {
			return redirect()->route('admin.posts.edit',$postId)->withErrors(__('posts.updated_failed'));
		}
		return redirect()->route('admin.posts.edit', $post->id)->withSuccess(__('posts.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(int $postId): RedirectResponse
	{
		if(!$this->post->deletePost($postId)){
			return redirect()->route('admin.posts.index')->withErrors(__('posts.deleted_failed'));
		}
		return redirect()->route('admin.posts.index')->withSuccess(__('posts.deleted'));
	}
}
