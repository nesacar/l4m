<ul class="stepper" style="width: 240px;">
  @foreach($steps as $index => $step)
  <li>
    <a class="step"
      href="{{$step->link}}"
      @if(isset($step->disabled) && $step->disabled) disabled @endif
      >
      <span class="step_icon">{{$index + 1}}</span>
      {{$step->text}}
    </a>
  </li>
  @endforeach
</ul>
