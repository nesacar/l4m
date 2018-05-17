<div class="checkbox checkbox--sm">
  <input class="checkbox_control" id="{{ $id }}" value="{{ $value }}" name="filters[]" type="checkbox" {{ request('filters') && in_array($value, request('filters')) ? 'checked' : '' }} />
  <div class="checkbox_background">
    <svg class="checkbox_checkmark" viewBox="0 0 24 24">
      <path class="checkbox_path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
    </svg>
  </div>
</div>
<label class="checkbox_label" title="{{ $label }}" for="{{ $id }}">
  {{ $label }}
</label>