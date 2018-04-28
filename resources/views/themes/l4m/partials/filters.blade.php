<form method="GET" class="filters" id="filters">
    <div class="filter">
        @if(count($properties)>0)
            @foreach($properties as $property)
                <h4 class="filter_name">{{ $property->title }}</h4>
                @if(count($property->attribute))
                    <ul class="filter-list with-scrollbar">
                        @foreach($property->attribute as $attribute)
                            @if(in_array($attribute->id, $results['att_ids']))
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
                @endif
            @endforeach
        @endif
    </div>
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