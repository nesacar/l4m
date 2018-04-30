<form method="GET" class="filters" id="filters">
  @if(count($properties)>0)
      @foreach($properties as $property)
          <div class="filter">
          <h4 class="filter_name">{{ $property->title }}</h4>
                @if(count($property->attribute))
                    <ul class="filter-list with-scrollbar">
                        @foreach($property->attribute as $attribute)
                            @if(in_array($attribute->id, $data['attIds']))
                                <li class="filter-list_item">
                                    @checkbox([
                                      'id' => 'ch-' . $attribute->id,
                                      'value' => $attribute->id,
                                      'label' => $attribute->title,
                                    ])
                                    @endcheckbox
                                </li>
                            @endif
                        @endforeach
                    </ul>
                  </div>
                @endif
            @endforeach
        @endif
    <div class="filter">
        <h4 class="filter_name">cena</h4>
        @doubleslider([
          'id' => 'price',
          'min' => $data['min'],
          'max' => $data['max'],
          'range' => $data['range'],
        ])
        @enddoubleslider
    </div>
    <button class="btn btn--primary" type="submit">filtriraj</button>
</form>