<div class="image-box">
  <div class="image-box_thumbnails image-gallery_thumbnails">
    
    <div class="image-box_thumbnail">
      <div class="image image--portrait">
        <img class="active" src="{{ \Imagecache::get($image, '90x120')->src }}" alt="{{ $title }}" data-large="{{ url($image) }}">
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
  </div>
  <div class="image-box_image">
    <div class="shop-item_image" style="position: relative;">
      <div class="image image--portrait">
        <img src="{{ url($image) }}" class="zoomer-target image-gallery_target" draggable="false"/>
      </div>
      <canvas class="zoomer"></canvas>
    </div>
  </div>
</div>