<div class="row my-3">
	<div class="form-group mb-3 col-md-6">
    <label class="form-label" for="title">
      @lang('posts.attributes.title')
    </label>
    <input type="text" id="title" name="title" @class(['form-control', 'is-invalid' => $errors->has('title')]) required value="{{ old('title', $post ?? null) }}">
    @error('title')
      <span class="invalid-feedback">{{ $message }}</span>
    @enderror
	</div>
	<div class="form-group mb-3 col-md-6">
    <label class="form-label" for="author_id">
			@lang('posts.attributes.author')
		</label>
		<select name="author_id" id="author_id" @class(['form-control', 'is-invalid' => $errors->has('author_id')]) required>
			@foreach ($users as $id => $name)
				<option value="{{ $id }}" @selected(old('author_id', $post ?? null) == $id)>
					{{ $name }}
				</option>
			@endforeach
		</select>
		@error('author_id')
			<span class="invalid-feedback">{{ $message }}</span>
		@enderror
	</div>
</div>
<div class="form-group mb-5">
	<label class="form-label" for="content">
		@lang('posts.attributes.content')
	</label>
	<textarea name="content" id="content" cols="50" rows="15" required @class(['form-control', 'is-invalid' => $errors->has('content')])>
    {{ old('content', $post ?? null) }}
  </textarea>
	@error('content')
		<span class="invalid-feedback">{{ $message }}</span>
	@enderror
</div>
