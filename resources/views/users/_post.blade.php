<x-card class='mb-3'>
  <h4 class="card-title">
    <a href="{{ route('posts.show', $post->id) }}" class="text-dark text-decoration-none">
      {{ $post->title }}
    </a>
  </h4>
  <p class="card-text">
    <small class="text-body-secondary">@customizeDate($post->updated_at)</small><br>
  </p>
</x-card>
