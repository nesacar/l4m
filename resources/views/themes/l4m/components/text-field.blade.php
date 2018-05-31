@php
  $error = isset($error_message) && $error_message != "";
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
  <div class="{{$className}} focusable js-input-field">
    <input class="text-field_input js-input"
      type="{{$type}}"
      name="{{$name}}"
      id="{{$id}}"
      value="{{$value}}"
      @if($required) required @endif
    >
    <label class="float-label" for="{{$id}}">{{$label}}</label>
    <div class="ripple-line"></div>
  </div>
  @if($error)
  <p class="helper-text">{{$error_message}}</p>
  @endif
</div>
