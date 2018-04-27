<div class="row image-box">
  <div class="col-lg-2">
    <div class="image-box_thumbnails">
      @for($i = 0; $i < 5; $i++)
      <div class="image-box_thumbnail">
        <div class="image image--portrait">
          <img src="{{ $image }}">
        </div>
      </div>
      @endfor
    </div>
  </div>
  <div class="col-lg-10 image-box_image">
    <div class="shop-item_image">
      <div class="image image--portrait">
        <img src="{{ $image }}">
      </div>
    </div>
  </div>
</div>