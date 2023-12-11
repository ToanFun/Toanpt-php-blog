@extends('layouts.app')

@section('content')

  @include ('posts/_search_form')

  <div id="posts">
    <div class="d-flex justify-content-between gap-2">
      <div class="p-2">
        @if (request()->has('key'))
          <h2>{{ trans_choice('posts.search_results', $count, ['query' => request()->input('key')]) }}</h2>
        @else
          <h2>Lastest Posts</h2>
        @endif
      </div>
    </div>

    @include ('posts/_list')
  </div>
@endsection