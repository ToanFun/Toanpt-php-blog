<section class="space-y-6">
	<header>
		<h2 class="text-lg font-medium text-gray-900">
			{{ __('Delete Account') }}
		</h2>
		<p class="mt-1 text-sm text-gray-600">
			{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
		</p>
	</header>
	<button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
		x-data=""
		x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
	>{{ __('Delete Account') }}</button>
	<x-modal name="confirm-user-deletion" :show="$errors->password->isNotEmpty()" focusable>
		<form method="post" action="{{ route('users.destroy') }}" class="p-6">
			@csrf
			@method('delete')
			<h2 class="text-lg font-medium text-gray-900">
				{{ __('Are you sure you want to delete your account?') }}
			</h2>
			<p class="mt-1 text-sm text-gray-600">
				{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
			</p>
			<div class="mt-6">
				<label class="block font-medium text-sm text-muted sr-only" for="password">
					{{ __('Password') }}
				</label>
				<input id="password" name="password" type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}"/>
				@error('password')
					<span class="invalid-feedback mt-2">{{ $errors->userDeletion->get('password') }}</span>
				@enderror
			</div>
			<div class="mt-6 flex justify-end">
				<button type="submit" x-on:click="$dispatch('close')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">
					{{ __('Cancel') }}
				</button>
				<button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
					{{ __('Delete Account') }}
				</button>
			</div>
		</form>
	</x-modal>
</section>
