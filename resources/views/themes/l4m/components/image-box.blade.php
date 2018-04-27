<div class="row image-box">
  <div class="col-lg-2">
    <div class="image-box_thumbnails">
      @for($i = 0; $i < 5; $i++)
      @php
        $className = "image-box_thumbnail" . (($i == 0) ? " image-box_thumbnail--active" : "");
      @endphp
      <div class="{{ $className }}">
        <div class="image image--portrait">
          <img src="{{ $image }}">
        </div>
      </div>
      @endfor
    </div>
  </div>
  <div class="col-lg-10 image-box_image">
    <div class="shop-item_image">
      <div class="image image--portrait lazy-image"
        data-src="{{ $image }}"
      >
      </div>
    </div>
  </div>
</div>