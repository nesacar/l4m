<form id="search-form">
  <div class="search-widget">
    <button class="icon-btn search-widget_search-btn" aria-label="pretraži" type="submit">
      <svg class="icon" role="presentation">
        <use xlink:href="#icon_search">
      </svg>
    </button>
    {{-- <label for="search-input" class="sr-only">Pretraži</label> --}}
    <input type="text" id="search-input" placeholder="Pretraži" />
    <div class="search-widget_border"></div>
    <button class="icon-btn search-widget_close-btn" aria-label="poništi" type="reset">
      <svg class="icon" role="presentation">
        <use xlink:href="#icon_close">
      </svg>
    </button>
  </div>
</form>