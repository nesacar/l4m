@php
    $controls = isset($options->controls) ? $options->controls : false;
@endphp


<section class="masthead" id="masthead">
    @carouselcontrols(['controls' => $controls])
    @endcarouselcontrols
    <div class="container masthead-carousel is-loading overflow--hidden">
        @foreach($data as $item)
            <div class="masthead-carousel_item">
                <div class="image masthead-image masthead-image--homepage invertable-image">
                    <picture>
                        <source media="(min-width: 696px)" srcset="{{$item->slider ? url($item->slider) : url($item->image)}}">
                        <img src="{{$item->slider ? url($item->slider) : url($item->small_image)}}"/>
                    </picture>
                </div>
                <div class="masthead-carousel_content--homepage">
                    <div class="masthead_action-box masthead_action-box--left">
                        @if(!empty($item->title))<h1 class="masthead_title display-2">{!! $item->title !!}</h1>@endif
                        @if(!empty($item->subtitle))<p class="masthead_desc">{!! $item->subtitle !!}</p>@endif
                        @if(!empty($item->button))<a class="btn btn--primary masthead_action" href="{{url($item->link)}}">{{$item->button}}</a>@endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
