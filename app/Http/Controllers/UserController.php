<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
	protected User $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Show user's detail and lastest user's posts
	 */
	public function show(Request $request, int $userId): View
	{
		try {
			$info = $this->user->getInfo($userId);
			return view("users.show", [
				'user' => $info['user'],
				'posts_count' => $info['posts_count'],
				'posts'=> $info['posts'],
			]);
		} catch (\Exception $e) {
			abort(404, $e->getMessage());
		}
	}
}
