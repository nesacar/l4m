<div class="double-slider"
  id={{ $id }}
  data-min={{ $min }}
  data-max={{ $max }}
  data-range={{ $range }}
>
  <div class="double-slider_track-wrap">
    <div class="double-slider_track js-double-slider_track"></div>
  </div>
  <div class="double-slider_control js-knob" data-controls="min">
    <div class="double-slider_control-knob"></div>
  </div>
  <div class="double-slider_control js-knob" data-controls="max">
    <div class="double-slider_control-knob"></div>
  </div>
</div>
<input class="double-slider_output" data-outputs="min" type="hidden" name="{{ $id }}[]" value="{{ $min }}">
<input class="double-slider_output" data-outputs="max" type="hidden" name="{{ $id }}[]" value="{{ $max }}">
@if(isset($label))
<div class="double-slider_values">
  <span><i data-label="min" class="double-slider_label">{{ $min }}</i> {{ $label }}</span>
  &minus;
  <span><i data-label="max" class="double-slider_label">{{ $max }}</i> {{ $label }}</span>
</div>
@endif