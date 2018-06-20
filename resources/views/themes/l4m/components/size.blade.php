@php
  $checked = isset($checked) ? $checked : false;
@endphp
<div class="size-picker">
  <input class="size-picker_control"
    type="radio"
    name="size"
    value="{{$value}}"
    @if($checked) checked @endif  
  />
  <div class="size-picker_value">{{$value}}</div>
</div>
