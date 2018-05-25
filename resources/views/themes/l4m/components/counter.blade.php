<div class="counter" id="counter-test">
  <button class="icon-btn counter_control counter_control--decrement" aria-label="decrement" aria-controls="{{ $id }}" data-action="decrement">&minus;</button>
  <input class="counter_value" type="text" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">
  <button class="icon-btn counter_control counter_control--increment" aria-label="increment" aria-controls="{{ $id }}" data-action="increment">&plus;</button>
</div>