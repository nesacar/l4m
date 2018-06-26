<form method="GET" class="filters" id="filters">

    <div class="filter">
      <h4 class="filter_name">primenjeni filteri:</h4>
      <ul class="applied-filter-list js-applied-list">
        {{-- <li class="applied-filter-list_item">
          <div>
            <div class="text--xs text--bold text--uppercase text--hint">category</div>
            <div class="text--s text--bold">Hello, world!</div>
          </div>
          <button class="icon-btn">&times;</button>
        </li> --}}
      </ul>
      <button class="btn btn--outline btn--block js-reset-btn">poništi sve</button>
    </div>

    @if(count($properties)>0)
      @foreach($properties as $property)
        <div class="filter">
          <h4 class="filter_name">{{ $property->title }}</h4>
          @if(count($property->attribute))
            <ul class="filter-list with-scrollbar">
              @foreach($property->attribute as $attribute)
                @if(in_array($attribute->id, $data['attIds']))
                  @filter([
                    'id' => $attribute->id,
                    'value' => $attribute->id,
                    'label' => $attribute->title,
                    'category' => $property->title,
                  ])
                  @endfilter
                @endif
              @endforeach
            </ul>
          @endif
        </div>
      @endforeach
    @endif

    <div class="filter">
        <h4 class="filter_name">cena</h4>
        @doubleslider([
          'id' => 'price',
          'min' => $data['min'],
          'max' => $data['max'],
          'range' => $data['range'],
          'label' => \Session::get('currency')->symbol,
        ])
        @enddoubleslider
    </div>
    <button class="btn btn--primary btn--block" type="submit">filtriraj</button>
</form>