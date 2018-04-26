<form method="GET" class="filters">
  <div class="filter">
    <h4 class="filter_name">filter name</h4>
    <ul class="filter-list with-scrollbar">
      @for($i = 0; $i < 5; $i++)
      <li class="filter-list_item">
        @checkbox([
          'id' => 'ch-' . $i,
          'checked' => false,
          'value' => 'Filter value ' . $i
        ])
        @endcheckbox
      </li>
      @endfor
    </ul>
  </div>
  <button class="btn btn--primary" type="submit">filter</button>
</form>