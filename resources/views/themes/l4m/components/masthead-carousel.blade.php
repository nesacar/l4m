@php
  $hasOptions = isset($options);
  $controls = true;
  $hasContent = true;

  if ($hasOptions) {
    $controls = isset($options->controls) ? $options->controls : $controls;
    $hasContent = isset($options->content) ? $options->content : $hasContent;
  }
@endphp

<section class="masthead" id="masthead">
  <div class="container masthead-carousel overflow--visible is-loading js-carousel">
    @foreach($data as $item)
    <div class="masthead-carousel_item">
      <div class="image image--ultra-wide masthead-image">
        <img src="{{ $item->slider? url($item->slider) : url($item->image) }}" />
      </div>
      @if($hasContent)
      <div class="masthead-carousel_content">
        <div class="masthead_label">
          @if($item->category)
            <a href="{{ $item->category->getLink() }}">{{ $item->category->title }} </a>
          @else
            <a href="{{ $item->blog->getLink() }}">{{ $item->blog->title }}</a>
          @endif
        </div>
        <h3 class="masthead_title"><a href="{{ url($item->getLink()) }}">{{ $item->title }}</a></h3>
        <p class="masthead_desc">{{ $item->subtitle }}</p>
      </div>
      @endif
    </div>
    @endforeach
  </div>
</section>