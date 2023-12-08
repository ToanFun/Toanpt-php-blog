@extends('admin.layouts.app')

@section('content')
	<p>
		@lang('posts.show') :

		<a href="{{ route('posts.show', $post->id) }}">
			{{ route('posts.show', $post->id) }}
		</a>
	</p>

	<form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
		@method('PUT')
		@csrf

		@include('admin/posts/_form')

		<div class="pull-left">
			<a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
				<x-icon name="chevron-left" />

				@lang('forms.actions.back')
			</a>

			<button type="submit" class="btn btn-primary text-primary">
				<x-icon name="save" />

				@lang('forms.actions.update')
			</button>
		</div>
	</form>
@endsection
