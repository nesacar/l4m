<div class="checkbox">
  <input class="checkbox_control" id="{{ $id }}" type="checkbox" {{ $checked ? 'checked' : '' }} />
  <div class="checkbox_background">
    <svg class="checkbox_checkmark" viewBox="0 0 24 24">
      <path class="checkbox_path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
    </svg>
  </div>
</div>
<label class="checkbox_label" title="{{ $value }}" for="{{ $id }}">
  {{ $value }}
</label>