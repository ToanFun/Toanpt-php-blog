<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Exception;

class RegisterController extends Controller
{
	protected User $user;
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Display the registration view.
	 */
	public function create(): View
	{
		return view('auth.register');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(RegisterRequest $request): RedirectResponse
	{
		try {
			$data_user = [
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
			];
			$user = $this->user->createNewUser($data_user);
			event(new Registered($user));
			Auth::login($user);
			return redirect(RouteServiceProvider::HOME);
		} catch (Exception $e) {
			abort(500, $e->getMessage());
		}
	}
}
