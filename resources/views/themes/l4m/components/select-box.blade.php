@php
  $error = isset($error_message) && $error_message != "";
  $required = isset($required) ? $required : false;

  $className = "select-box";
  $className = $error
    ? ($className." error")
    : $className;
  $className = $required
    ? ($className." required")
    : $className;
@endphp

<div class="input-container">
  <div class="{{$className}} focusable js-input-field">
    <select class="select-box_input js-input"
      name="{{$name}}"
      id="{{$id}}"
      @if($required) required @endif
    >
      <option disabled selected value></option>
      {{$slot}}
    </select>
    <label class="float-label" for="{{$id}}">{{$label}}</label>
    <div class="ripple-line"></div>
  </div>
  @if($error)
  <p class="helper-text">{{$error_message}}</p>
  @endif
</div>
