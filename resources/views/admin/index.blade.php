@extends('admin.layouts.app')

@section('content')
  <div class="page-header">
    <h1>This week</h1>
  </div>
  <div class="row d-flex justify-content-center">
    <div class="col-xl-5 col-sm-6 mb-3">
      @include('admin/_posts')
    </div>
    <div class="col-xl-5 col-sm-6 mb-3">
      @include('admin/_users')
    </div>
  </div>
@endsection
