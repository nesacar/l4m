<div class="row image-box">
  <div class="col-lg-2">
    <div class="image-box_thumbnails">

      <div class="image-box_thumbnail image-box_thumbnail--active">
        <div class="image image--portrait">
          <img src="{{ \Imagecache::get($image, '63x84')->src }}" alt="{{ $title }}">
        </div>
      </div>
      @if(count($photos))
      <div class="image-box_thumbnail">
        <div class="image image--portrait">
          @foreach ($photos as $photo)
            <img src="{{ url($photo->tmb) }}" alt="{{ $title }}">
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </div>
  <div class="col-lg-10 image-box_image">
    <div class="shop-item_image" style="position: relative;">
      <div class="image image--portrait">
        <img src="{{ url($image) }}" class="zoomer-target" draggable="false"/>
      </div>
      <canvas class="zoomer"></canvas>
    </div>
  </div>
</div>