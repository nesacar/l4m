@php
  $active = isset($active) ? $active : false;
  $classname = 'color-picker'.($active ? ' active' : '');
@endphp
<a class="{{$classname}}"
  href="{{$link}}"
  style="color: {{$colorValue}};"
></a>
