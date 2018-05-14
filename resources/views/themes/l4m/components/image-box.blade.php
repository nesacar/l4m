<div class="row image-box">
  <div class="col-lg-3">
    <div class="image-box_thumbnails image-gallery_thumbnails">
      
      <div class="image-box_thumbnail">
        <div class="image image--portrait">
          <img class="active" src="{{ \Imagecache::get($image, 'test')->src }}" alt="{{ $title }}">
        </div>
      </div>
      @if(count($photos))
      @foreach ($photos as $photo)
      <div class="image-box_thumbnail">
        <div class="image image--portrait">
          <img src="{{ url($photo->tmb) }}" alt="{{ $title }}">
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
  <div class="col-lg-9 image-box_image">
    <div class="shop-item_image" style="position: relative;">
      <div class="image image--portrait">
        <img src="{{ url($image) }}" class="zoomer-target image-gallery_target" draggable="false"/>
      </div>
      <canvas class="zoomer"></canvas>
    </div>
  </div>
</div>