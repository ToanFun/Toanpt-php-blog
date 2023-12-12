@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <x-card class="text-center mb-2">
        <h2 class="card-title mb-0">{{ $user->name }}</h2>
        <small class="card-subtitle mb-2 text-body-secondary">{{ $user->email }}</small>
        <div class="card-text row mt-3">
          <div class="col-md-4">
            <span class="text-body-secondary d-block">Posts</span>
            {{ $posts_count }}
          </div>
        </div>
        @owner($user->id)
          <a href="#" class="btn btn-primary btn-sm float-end">
            Edit profile
          </a>
        @endowner
      </x-card>
    </div>
  </div>

  <div class="row">

    <div class="col-md-6">
      <h2>Lastest Posts</h2>

      <div class="space-y-3">
        @if ($posts->isNotEmpty())
          @each('users/_post', $posts, 'post')
        @else
          <p>There is no post for the moment.</p>
        @endif
      </div>
    </div>
  </div>
@endsection
