@extends('admin.layouts.app')

@section('content')
	<h1>Create post</h1>
	<form action="{{ route('admin.posts.store') }}" method="POST">
		@csrf
		@include('admin/posts/_form')
		<a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
			<x-icon name="chevron-left" />
			Back
		</a>
		<button type="submit" class="btn btn-primary">
			<x-icon name="save" />
			Save
		</button>
	</form>
@endsection
