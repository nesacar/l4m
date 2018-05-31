<ul class="stepper">
  @foreach($steps as $index => $step)
  <li>
    <a class="step"
      href="{{$step->link}}"
      @if(isset($step->disabled) && $step->disabled) disabled tabindex="-1" @endif
      >
      <span class="step_icon" title="{{$step->text}}">{{$index + 1}}</span>
      <span class="step_text expand--lg">{{$step->text}}</span>
    </a>
  </li>
  @endforeach
</ul>
