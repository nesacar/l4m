@php
  $checked = isset($checked) ? $checked : false;
@endphp
<div class="size-picker">
  <input class="size-picker_control js-size-picker"
    type="radio"
    name="size"
    value="{{$value}}"
    @if($checked) checked @endif  
  />
  <div class="size-picker_value">{{$label}}</div>
</div>
