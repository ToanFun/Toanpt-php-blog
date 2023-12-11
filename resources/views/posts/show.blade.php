@extends('layouts.app')

@section('content')
	<x-card>
		<h1>{{ $post->title }}</h1>

		<div class="mb-3">
			<small class="text-body-secondary">
				<a href="{{ route('users.show', $post->author->id) }}">
					{{ $post->author->name }}
				</a>
			</small>

			<small class="text-body-secondary">@customizeDate($post->updated_at)</small>
		</div>

		<div class="post-content">
			{!! $post->content !!}
		</div>

	</x-card>

@endsection