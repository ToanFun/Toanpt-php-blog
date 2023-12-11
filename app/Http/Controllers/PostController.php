<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{

	protected Post $post;
	public function __construct(Post $post)
	{
		$this->post = $post;
	}
	public function index(Request $request): View
	{
		$searchKey = $request->input("key");
		$results = $this->post->listPosts($searchKey);
		return view("posts.index", [
			"posts" => $results["posts"],
			"count" => $results["countPosts"],
		]);
	}
	public function show(Request $request, int $postId): View
	{
		if (!$this->post->find($postId)) {
			throw new ModelNotFoundException;
		}
		$post = $this->post->getPost($postId);
		return view("posts.show", [
			"post"=> $post,
		]);
	}
}
