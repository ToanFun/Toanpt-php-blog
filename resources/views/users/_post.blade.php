<x-card>
  <h4 class="card-title">
    <a href="{{ route('posts.show', $post->id) }}">
      {{ $post->title }}
    </a>
  </h4>

  <p class="card-text">
    <small class="text-body-secondary">@humanize_date($post->updated_at)</small><br>
  </p>
</x-card>
