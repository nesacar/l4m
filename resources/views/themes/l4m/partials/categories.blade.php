<div class="row home_categories">
  @foreach($categories as $category)
  <a href="{{ url('shop/' . $category->slug) }}" class="col-md-3 home_category with-flare with-scrim">
    <div class="image image--portrait home_category-image">
      <img src="{{ url($category->box_image) }}" alt="{{ $category->title }}">
    </div>
    <div class="home_category-title">
      <h3 class="home_category-text home_category-text--underline">{{ $category->title }}</h3>
    </div>
  </a>
  @endforeach
</div>