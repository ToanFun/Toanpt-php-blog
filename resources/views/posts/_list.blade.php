<div class="row row-cols-1 row-cols-lg-2 g-4 mb-3">
  @each('posts/_show', $posts, 'post', 'posts/_empty')
</div>
<div class="d-flex justify-content-center">
  {{ $posts->links() }}
</div>
