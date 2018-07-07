<div class="image-box">
    <div class="image-box_thumbnails image-gallery_thumbnails expand--md">

        <div class="image-box_thumbnail">
            <div class="image image--portrait">
                <img class="active" src="{{ \Imagecache::get($image, '90x120')->src }}" alt="{{ $title }}"
                     data-large="{{ url($image) }}">
            </div>
        </div>
        @if(count($photos))
            @foreach ($photos as $photo)
                <div class="image-box_thumbnail">
                    <div class="image image--portrait">
                        <img src="{{ url($photo->tmb) }}" alt="{{ $title }}" data-large="{{ url($photo->file_path) }}">
                    </div>
                </div>
            @endforeach
        @endif
    </div><!-- /.image-box_thumbnails -->

    <div class="image-box_image">
        <div class="image-box_zoom js-zoomer-trigger">
            <svg class="icon image-box_zoom-icon">
                <use xlink:href="#icon_zoom">
            </svg>
        </div>
        <div class="image-box_controls">
            <button class="icon-btn image-box_arrow image-box_arrow--left js-arrow--prev"
                    aria-label="prev"
            >
                <span class="arrow arrow--left" role="presentation"></span>
            </button>
            <button class="icon-btn image-box_arrow image-box_arrow--right js-arrow--next"
                    aria-label="next"
            >
                <span class="arrow arrow--right" role="presentation"></span>
            </button>
        </div><!-- /.image-box_controls -->
        <div class="demo-siema loading">
            <div class="image-box_image-wrap">
                <div class="image image--portrait">
                    {{-- <img src="{{ url($image) }}" class="zoomer-target image-gallery_target" draggable="false"/> --}}
                    <img src="{{ url($image) }}">
                </div>
            </div>
            @if(count($photos))
                @foreach($photos as $photo)
                    <div class="image-box_image-wrap">
                        <div class="image image--portrait">
                            <img src="{{ url($photo->file_path) }}">
                        </div>
                    </div>
                @endforeach
            @endif
        </div><!-- /carousel -->
        {{-- <canvas class="zoomer"></canvas> --}}
    </div>
</div>