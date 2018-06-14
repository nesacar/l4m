@php
  $checked = isset($checked) ? $checked : false;
@endphp
<div class="radio-wrap">
  <div class="radio">
    <input class="radio_control"
      id="{{$id}}"
      type="radio"
      name="{{$name}}"
      value="${{$value}}"
      @if($checked) checked @endif
    >
    <div class="radio_background">
      <div class="radio_outer-circle"></div>
      <div class="radio_inner-circle"></div>
    </div>
  </div>
  @if(isset($label))
    <label class="radio_label" for="{{$id}}">{{$label}}</label>
  @endif
</div>
