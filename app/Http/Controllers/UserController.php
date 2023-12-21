<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


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

	/**
	 * Display the user's profile form.
	 */
	public function edit(): View
	{
		return view('users.edit', [
			'user' => Auth::user(),
		]);
	}

	/**
	 * Update the user's profile information.
	 */
	public function update(UserRequest $request): RedirectResponse
	{
		$request->user()->fill($request->validated());
		if ($request->user()->isDirty('email')) {
			$request->user()->email_verified_at = null;
		}
		$request->user()->save();
		return Redirect::route('profile.edit')->with('status', 'profile-updated');
	}

	/**
	 * Delete the user's account.
	 */
	public function destroy(DestroyUserRequest $request): RedirectResponse
	{
		$user = $request->user();
		Auth::logout();
		$user->delete();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return Redirect::to('/');
	}
}
