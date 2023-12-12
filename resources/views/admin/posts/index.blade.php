@extends('admin.layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between">
      <h1>Posts</h1>
      <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm align-self-center">
        <x-icon name="plus-square" prefix="fa-regular" />
        Add
      </a>
    </div>
    @include ('admin/posts/_list')
@endsection
