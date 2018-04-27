<div class="select">
  <select class="select_input" name="{{ $name }}" id="{{ $id }}" @if(isset($form)) form="{{ $form }}" @endif>
    {{ $slot }}
  </select>
</div>
