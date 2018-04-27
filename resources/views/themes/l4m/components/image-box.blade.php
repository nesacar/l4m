<div class="row">
  <div class="col-lg-2">
    @for($i = 0; $i < 3; $i++)
    <div class="shop-item_image" style="margin-bottom: 16px;">
      <div class="image image--portrait">
        <img src="{{ $image }}">
      </div>
    </div>
    @endfor
  </div>
  <div class="col-lg-10">
    <div class="shop-item_image">
      <div class="image image--portrait">
        <img src="{{ $image }}">
      </div>
    </div>
  </div>
</div>