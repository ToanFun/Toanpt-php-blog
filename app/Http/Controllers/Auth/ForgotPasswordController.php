<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
	/**
	 * Display the password reset link request view.
	 */
	public function create(): View
	{
		return view('auth.passwords.email');
	}

	/**
	 * Handle an incoming password reset link request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(ForgotPasswordRequest $request): RedirectResponse
	{
		try {
			// We will send the password reset link to this user. Once we have attempted
			// to send the link, we will examine the response then see the message we
			// need to show to the user. Finally, we'll send out a proper response.
			$status = Password::sendResetLink(
				$request->only('email')
			);

			return $status == Password::RESET_LINK_SENT
						? back()->with('status', __($status))
						: back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
		} catch (\Exception $e) {
			return back()->with('status', 'Something\'s wrong. Please try again.');
		}
	}
}
