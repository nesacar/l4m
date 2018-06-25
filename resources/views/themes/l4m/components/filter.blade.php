@php
  $checked = request('filters') && in_array($value, request('filters'));
@endphp
<li class="filter-list_item"
  data-id="ch-{{$id}}"
  data-value={{$label}}
  data-category={{$category}}
  {{$checked ? "data-checked" : ""}}
>
  @checkbox([
    'id' => 'ch-'.$id,
    'value' => $value,
    'label' => $label,
    'checked' =>$checked,
  ])
  @endcheckbox
</li>