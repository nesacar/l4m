@php
  $controls = isset($options->controls) ? $options->controls : false;
@endphp


<section class="masthead" id="masthead">
  <div class="container masthead-carousel is-loading overflow--hidden js-carousel">
    @foreach($data as $item)
    @php
      $has_content = !empty($item->title)
        && !empty($item->subtitle)
        && !empty($item->button);
    @endphp
    <div class="masthead-carousel_item">
      @if(!$has_content) <a href="{{url($item->link)}}"> @endif
        <div class="image masthead-image masthead-image--homepage invertable-image">
          <picture>
            <source media="(min-width: 696px)"
              srcset="{{$item->slider ? url($item->slider) : url($item->image)}}">
            <img src="{{$item->slider ? url($item->slider) : url($item->small_image)}}"/>
          </picture>
        </div>
      @if(!$has_content) </a> @endif
      @if($has_content)
      <div class="masthead-carousel_content--homepage">
        <div class="masthead_action-box masthead_action-box--left">
          <h1 class="masthead_title display-2">{!! $item->title !!}</h1>
          <p class="masthead_desc">{!! $item->subtitle !!}</p>
          <a class="btn btn--primary masthead_action"
            href="{{url($item->link)}}"
          >{{$item->button}}</a>
        </div>
      </div>
      @endif
    </div>
    @endforeach
  </div>
</section>
