<form method="GET" class="filters">
  <div class="filter">
    <h4 class="filter_name">filter name</h4>
    <ul class="filter-list">
      @for($i = 0; $i < 5; $i++)
      <li class="filter-list_item">
        @component('themes.' . env('THEME_NAME', '') . '.components.checkbox', [
          'id' => 'ch-' . $i,
          'checked' => false,
          'value' => 'Filter value ' . $i
        ])
        @endcomponent
      </li>
      @endfor
    </ul>
  </div>
  <button class="btn btn--primary" type="submit">filter</button>
</form>