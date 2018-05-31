@php
  $error = isset($error) ? $error : false;
  $required = isset($required) ? $required : false;
  $type = isset($type) ? $type : "text";
  $value = isset($value) ? $value : "";

  $className = "text-field";
  $className = $error
    ? ($className." error")
    : $className;
  $className = $required
    ? ($className." required")
    : $className;
@endphp

<div class="input-container">
  <div class="{{$className}}">
    <input class="text-field_input"
      type="{{$type}}"
      name="{{$name}}"
      id="{{$id}}"
      value="{{$value}}"
      @if($required) required @endif
    >
    <label class="float-label" for="{{$id}}">{{$label}}</label>
    <div class="ripple-line"></div>
  </div>
  @if(isset($helper_text))
  <p class="text-field_helper-text">{{$helper_text}}</p>
  @endif
</div>
