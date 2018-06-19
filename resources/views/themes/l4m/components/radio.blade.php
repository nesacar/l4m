@php
  $checked = isset($checked) ? $checked : false;
  $inverse = isset($inverse) ? $inverse : false;

  $className = "radio".($inverse ? " radio--inverse" : "");
@endphp
<div class="radio-wrap">
  <div class="{{$className}}">
    <input class="radio_control"
      id="{{$id}}"
      type="radio"
      name="{{$name}}"
      value="{{$value}}"
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
