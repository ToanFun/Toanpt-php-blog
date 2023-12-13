<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;

class DashboardController extends Controller
{
	protected Post $post;
	protected User $user;

	public function __construct(Post $post, User $user)
	{
		$this->post = $post;
		$this->user = $user;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function __invoke(): View
	{
		return view('admin.index', [
			'postsCount' => $this->post->countNewestPostsInWeek(),
			'usersCount' => $this->user->countNewestUsersInWeek(),
		]);
	}
}
