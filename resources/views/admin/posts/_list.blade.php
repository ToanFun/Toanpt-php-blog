<table class="table table-striped table-sm table-responsive-md">
  <caption>{{ trans_choice('posts.count', $posts->total()) }}</caption>
  <thead>
	  <tr>
		  <th>@lang('posts.attributes.title')</th>
		  <th>@lang('posts.attributes.author')</th>
		  <th>Updated</th>
		  <th></th>
	  </tr>
  </thead>
  <tbody>
	  @foreach($posts as $post)
		  <tr>
			  <td>
				  <a href="{{ route('admin.posts.edit', $post->id) }}">
					  {{ $post->title }}
				  </a>
			  </td>
			  <td>
				  <a href="{{ route('admin.users.edit', $post->author->id) }}">
					  {{ $post->author->fullname }}
				  </a>
			  </td>
			  <td>@humanize_date($post->updated_at, 'd/m/Y H:i:s')</td>
			  <td>
					<div class="d-flex flex-row justify-content-around">
						<a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary btn-sm">
							<x-icon name="edit" />
						</a>

						<form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="form-inline" data-confirm="@lang('forms.posts.delete')">
							@method('DELETE')
							@csrf

							<button type="submit" name="submit" class="btn btn-outline-danger btn-sm">
								<x-icon name="trash" />
							</button>
						</form>
					</div>
			  </td>
		  </tr>
	  @endforeach
  </tbody>
</table>

<div class="d-flex justify-content-center">
  {{ $posts->links() }}
</div>
