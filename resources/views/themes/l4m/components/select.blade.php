<div class="select select-carrot focusable js-input-field">
  <select class="select_input js-input"
    id="{{ $id }}"
    name="{{ $name }}"
    @if(isset($form)) form="{{ $form }}" @endif
  >
    {{ $slot }}
  </select>
  <div class="ripple-line"></div>
</div>
