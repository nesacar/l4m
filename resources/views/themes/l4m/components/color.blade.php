@php
  $checked = isset($checked) ? $checked : false;
@endphp
<div class="color-picker"
  style="color: {{$colorValue}};"
>
  <input class="color-picker_control"
    type="radio"
    name="color"
    value="{{$colorName}}"
    @if($checked) checked @endif
  />
  <div class="color-picker_outer-circle"></div>
  <div class="color-picker_inner-circle"></div>
</div>
