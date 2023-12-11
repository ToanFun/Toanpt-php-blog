<div class="col">
  <x-card>
    <h4 class="card-title">
      <a href="{{ route('posts.show', $post->id) }}" data-turbo-frame="_top">
        {{ $post->title }}
      </a>
    </h4>

    <p class="card-text">
      <small class="text-body-secondary">
        <a href="{{ route('users.show', $post->author->id) }}" data-turbo-frame="_top">
          {{ $post->author->name }}
        </a>
      </small>
    </p>
  </x-card>
</div>
