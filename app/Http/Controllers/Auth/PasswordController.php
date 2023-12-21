<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
	/**
	 * Update the user's password.
	 */
	public function update(PasswordRequest $request): RedirectResponse
	{
		try {
			$request->user()->update([
				'password' => Hash::make($request->password),
			]);

			return back()->with('status', 'password-updated');
		}
		catch (\Exception $e) {
			return back()->with('status', 'Something\'s wrong. Please try again.');
		}
	}
}
