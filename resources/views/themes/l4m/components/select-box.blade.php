<div class="input-container">
  <div class="select-box focusable js-input-field">
    <select class="select-box_input js-input"
      name="{{$name}}"
      id="{{$id}}"
    >
      <option disabled selected value></option>
      {{$slot}}
    </select>
    <label class="float-label" for="{{$id}}">{{$label}}</label>
    <div class="ripple-line"></div>
  </div>
</div>
