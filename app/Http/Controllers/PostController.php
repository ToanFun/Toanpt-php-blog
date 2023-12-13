<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{

	protected Post $post;
	public function __construct(Post $post)
	{
		$this->post = $post;
	}

	/**
	 * Show all posts
	*/
	public function index(Request $request): View
	{
		$searchKeys = $request->only("key");
		$results = $this->post->listPosts($searchKeys);
		return view("posts.index", [
			"posts" => $results["posts"],
			"count" => $results["countPosts"],
		]);
	}

	/**
	 * Show post's detail
	 */
	public function show(Request $request, int $postId): View
	{
		$post = $this->post->getPost($postId);
		return view("posts.show", [
			"post"=> $post,
		]);
	}
}
