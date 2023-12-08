<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	public function index(Request $request): View
	{
		return view('posts.index', [
			'posts' => Post::search($request->input('q'))
				->with('author')
				->latest()
				->paginate(20)
		]);
	}

	public function show(Request $request, int $post_id): View
	{
		$post = Post::find($post_id);
		return view('posts.show', [
			'post' => $post
		]);
	}
}
