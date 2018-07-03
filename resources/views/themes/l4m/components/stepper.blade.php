<ul class="stepper">
  @foreach($steps as $index => $step)
  @php
    $innerHTML = isset($step->icon) ? $step->icon : ($index + 1);
  @endphp
  <li>
    <a class="step"
      href="{{$step->link}}"
      @if(isset($step->disabled) && $step->disabled) disabled tabindex="-1" @endif
      >
      <span class="step_icon" title="{{$step->text}}">{!! $innerHTML !!}</span>
      <span class="step_text expand--lg">{{$step->text}}</span>
    </a>
  </li>
  @endforeach
</ul>
