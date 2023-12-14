<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants\CommonConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
	protected User $user;
	protected Role $role;

	public function __construct(User $user, Role $role)
	{
		$this->user = $user;
		$this->role = $role;
	}

	/**
	 * Show the application users index.
	 */
	public function index(): View
	{
		$users = $this->user->listAllUsers(Auth::id());
		return view('admin.users.index', compact('users'));
	}

	/**
	 * Display the specified resource edit form.
	 */
	public function edit(int $userId): View
	{
		try {
			$user = $this->user->getById($userId);
			$roles = $this->role->getAllRoles();
			return view('admin.users.edit', [
				'user' => $user,
				'roles' => $roles
			]);
		} catch (\Exception $e) {
			abort(404, $e->getMessage());
		}
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UserRequest $request, int $userId): RedirectResponse
	{
		try {
			if ($request->filled('password')) {
				$request->merge(['password' => Hash::make($request->input('password'))]);
			}
			$updateParams = collect($request->only(['name', 'email', 'password']))->filter();
			$roleIds = collect(array_map('intval', $request->get('roles', [])))->values();
			if ($roleIds->contains(CommonConstant::ADMIN_ROLE_ID)) {
				$updateParams->put('admin_id', Auth::id());
			}
			$user = $this->user->updateUserInfo($updateParams->all(), $userId, $roleIds->all());
			return redirect()->route('admin.users.edit', $user->id)->withSuccess(__('users.updated'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->route('admin.users.edit', $userId)->withErrors(__('users.updated_failed'));
		}
	}
}
