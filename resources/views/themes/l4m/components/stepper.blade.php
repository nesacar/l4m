<ul class="stepper">
    @foreach($steps as $index => $step)
        @php
            $innerHTML = isset($step->icon) ? $step->icon : ($index + 1);
            $isActive = isset($step->active) ? $step->active : false;
            $classname = 'step' . ($isActive ? ' step--active' : '');
        @endphp

        @if($step->text == 'Odjava')
            <li>
                <a class="{{$classname}}" href="{{$step->link}}" onclick="event.preventDefault(); document.getElementById('logout-form-step').submit();">
                    <span class="step_icon" title="{{$step->text}}">{!! $innerHTML !!}</span>
                    <span class="step_text expand--lg">{{$step->text}}</span>
                </a>
                <form id="logout-form-step" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @else
            <li>
                <a class="{{$classname}}"
                   href="{{$step->link}}"
                   @if(isset($step->disabled) && $step->disabled) disabled tabindex="-1" @endif
                >
                    <span class="step_icon" title="{{$step->text}}">{!! $innerHTML !!}</span>
                    <span class="step_text expand--lg">{{$step->text}}</span>
                </a>
            </li>
        @endif
    @endforeach
</ul>
