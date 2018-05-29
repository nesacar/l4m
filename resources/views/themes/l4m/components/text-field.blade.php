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

<div class="text-field-container">
  <div class="{{$className}}">
    <input class="text-field_input"
      type="{{$type}}"
      name="{{$name}}"
      id="{{$id}}"
      value="{{$value}}"
      @if($required) required @endif
    >
    <label class="text-field_label" for="{{$id}}">{{$label}}</label>
    <div class="text-field_line"></div>
  </div>
  @if(isset($helper_text))
  <p class="text-field_helper-text">{{$helper_text}}</p>
  @endif
</div>
