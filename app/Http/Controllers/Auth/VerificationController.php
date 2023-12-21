<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Constants\CommonConstant;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationController extends Controller
{
	/**
	 * Display the email verification prompt.
	 */
	public function notice(Request $request): RedirectResponse|View
	{
		return $request->user()->hasVerifiedEmail()
						? redirect()->intended(CommonConstant::HOME)
						: view('auth.verify');
	}
	/**
	 * Send a new email verification notification.
	 */
	public function store(Request $request): RedirectResponse
	{
		if ($request->user()->hasVerifiedEmail()) {
			return redirect()->intended(CommonConstant::HOME);
		}
		$request->user()->sendEmailVerificationNotification();
		return back()->with('status', 'verification-link-sent');
	}

}
