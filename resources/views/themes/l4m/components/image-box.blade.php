<div class="row image-box">
  <div class="col-lg-2">
    <div class="image-box_thumbnails">

      <div class="image-box_thumbnail--active">
        <div class="image image--portrait">
          <img src="{{ \Imagecache::get($image, '63x84')->src }}" alt="{{ $title }}">
        </div>
      </div>
      <div class="image-box_thumbnail">
        <div class="image image--portrait">
          @foreach ($photos as $photo)
            <img src="{{ url($photo->file_path_small) }}" alt="{{ $title }}">
          @endforeach
        </div>
      </div>
      </div>
  </div>
  <div class="col-lg-10 image-box_image">
    <div class="shop-item_image">
      <div class="image image--portrait lazy-image" data-src="{{ url($image) }}">
      </div>
    </div>
  </div>
</div>