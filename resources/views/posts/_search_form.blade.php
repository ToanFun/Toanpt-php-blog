<form action="{{ route('home') }}" method="GET" class="d-flex gap-2" data-turbo="true" data-turbo-frame="posts" data-turbo-action="advance">
  @csrf
  <div class="input-group">
    <input type="text" id="key" name="key" class="form-control" placeholder="Search Post Here" value="{{ request('key') }}">
  </div>
  <button type="submit" class="btn btn-primary">
    <x-icon name="magnifying-glass" />
  </button>
</form>
