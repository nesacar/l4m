<div class="filters">
  <div class="filter">
    <h4 class="filter_name">filter name</h4>
    <ul class="filter-list">
      <li class="filter-list_item">
        @component('themes.' . env('THEME_NAME', '') . '.components.checkbox', [
          'id' => 'ch-1',
          'checked' => false,
          'value' => 'Filter value'
        ])
        @endcomponent
      </li>
    </ul>
  </div>
</div>