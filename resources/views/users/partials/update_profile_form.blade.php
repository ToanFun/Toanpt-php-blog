<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900">
			{{ __('Profile Information') }}
		</h2>
		<p class="mt-1 text-sm text-gray-600">
			{{ __("Update your account's profile information and email address.") }}
		</p>
	</header>
	<form id="send-verification" method="post" action="{{ route('verification.send') }}">
		@csrf
	</form>
	<form method="post" action="{{ route('users.update') }}" class="mt-6 space-y-6">
		@csrf
		@method('patch')
		<div>
			<label class="block font-medium text-sm text-muted" for="name">
				{{ __('Name') }}
			</label>
			<input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" value="{{ old('name', $user->name) }}"/>
			@error('name')
				<span class="invalid-feedback">{{ $message }}</span>
			@enderror
		</div>
		<div>
			<label class="block font-medium text-sm text-muted" for="email">
				{{ __('Email') }}
			</label>
			<input id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="email" value="{{ old('email', $user->email) }}"/>
			@error('email')
				<span class="invalid-feedback">{{ $message }}</span>
			@enderror
			@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
				<div>
					<p class="text-sm mt-2 text-gray-800">
						{{ __('Your email address is unverified.') }}

						<button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
							{{ __('Click here to re-send the verification email.') }}
						</button>
					</p>
					@if (session('status') === 'verification-link-sent')
						<p class="mt-2 font-medium text-sm text-green-600">
							{{ __('A new verification link has been sent to your email address.') }}
						</p>
					@endif
				</div>
			@endif
		</div>
		<div class="flex items-center gap-4">
			<button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">{{ __('Save') }}</button>
			@if (session('status') === 'profile-updated')
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
