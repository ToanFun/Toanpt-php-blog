<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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
		$user = $this->user->getById($userId);
		$roles = $this->role->getAllRoles();
		return view('admin.users.edit', [
			'user' => $user,
			'roles' => $roles
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UserRequest $request, int $userId): RedirectResponse
	{
		$updateParams = array_filter($request->only(['name', 'email', 'password']));
		if (isset($updateParams['password'])) {
			$updateParams['password'] = Hash::make($updateParams['password']);
		}
		$roleIds = array_values($request->get('roles', []));
		$user = $this->user->updateUserInfo($updateParams, $userId, $roleIds);
		return redirect()->route('admin.users.edit', $user->id)->withSuccess(__('users.updated'));
	}
}
