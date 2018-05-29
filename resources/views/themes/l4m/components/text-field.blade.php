@php
  $error = isset($error) ? $error : false;
  $required = isset($required) ? $required : false;
  $type = isset($type) ? $type : "text";

  $containerCN = "text-field-container";
  $containerCN = $error
    ? ($containerCN." error")
    : $containerCN;
  $containerCN = $required
    ? ($containerCN." required")
    : $containerCN;
@endphp

<div class="{{$containerCN}}" style="width: 240px;">
  <div class="text-field">
    <input class="text-field_input"
      type="{{$type}}"
      name="{{$name}}"
      id="{{$id}}"
      @if($required) required @endif
    >
    <label class="text-field_label" for="{{$id}}">{{$label}}</label>
    <div class="text-field_line"></div>
  </div>
  @if(isset($helper_text))
  <p class="text-field_helper-text">{{$helper_text}}</p>
  @endif
</div>
