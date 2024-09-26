<x-card class="bg-warning text-light m-2">
  <div class="row justify-content-between">
	  <x-icon name="users" class="fa-5x" />
	  <div class="col text-end">
		  <div class="fa-2x">{{ $usersCount }}</div>
		  <div>{{ trans_choice('users.new_users', $usersCount) }}</div>
	  </div>
  </div>
  <x-slot:footer>
	  <a href="{{ route('admin.users.index') }}" class="d-flex justify-content-between text-light">
		  <span>Details</span>
		  <span><x-icon name="arrow-circle-right" /></span>
	  </a>
  </x-slot>
</x-card>
