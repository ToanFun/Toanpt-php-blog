@extends('admin.layouts.app')

@section('content')
	<p>
		Show profile :
		<a href="{{ route('users.show', $user->id) }}">
			{{ route('users.show', $user->id) }}
		</a>
	</p>
	@include('admin/users/_form')
@endsection
