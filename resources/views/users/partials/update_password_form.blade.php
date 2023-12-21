<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900">
			{{ __('Update Password') }}
		</h2>
		<p class="mt-1 text-sm text-gray-600">
			{{ __('Ensure your account is using a long, random password to stay secure.') }}
		</p>
	</header>
	<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
		@csrf
		@method('put')
		<div>
			<label class="block font-medium text-sm text-muted" for="update_password_current_password">
				{{ __('Current Password') }}
			</label>
			<input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password"/>
			@error('current_password')
				<span class="invalid-feedback mt-2">{{ $message }}</span>
			@enderror
		</div>
		<div>
			<label class="block font-medium text-sm text-muted" for="update_password_password">
				{{ __('New Password') }}
			</label>
			<input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
			@error('password')
				<span class="invalid-feedback mt-2">{{ $message }}</span>
			@enderror
		</div>
		<div>
			<label class="block font-medium text-sm text-muted" for="update_password_password_confirmation">
				{{ __('Confirm Password') }}
			</label>
			<input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
			@error('password_confirmation')
				<span class="invalid-feedback mt-2">{{ $message }}</span>
			@enderror
		</div>
		<div class="flex items-center gap-4">
			<button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">{{ __('Save') }}</button>
			@if (session('status') === 'password-updated')
				<p
					x-data="{ show: true }"
					x-show="show"
					x-transition
					x-init="setTimeout(() => show = false, 2000)"
					class="text-sm text-gray-600"
				>{{ __('Saved.') }}</p>
			@endif
		</div>
	</form>
</section>
