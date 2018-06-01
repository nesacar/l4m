<nav class="nav">
    @foreach($links as $i => $link)
        @php $className = $link->desc . (\App\Helper::activeLink($link->link)? ' ' . $link->desc . '--active' : ''); @endphp
        <div class="nav_item">
            @if(count($link->children)>0)
                <span class="{{ $className }}">{{ $link->title}}</span>
                <div class="mega-menu">
                    <div class="mega-menu_scrim"></div>
                    <div class="mega-menu_content">
                        <div class="container mega-menu_row">
                            <div class="menu-list mega-menu_col">
                                @foreach($link->children as $subLink)
                                    <a class="menu-list_item"
                                       href="{{url($subLink->link . $subLink->sufix)}}"
                                    >{{$subLink->title}}</a>
                                @endforeach
                            </div>
                            <!-- demo -->
                            @if(!empty($link->image))
                                <div class="demo-img-box">
                                    <div class="image image--ultra-wide">

                                        <img src="{{ url($link->image) }}" alt="{{ $link->link }}">

                                    </div>
                                    <span class="demo-something">{{ $link->title }}</span>
                                </div>
                                <!-- /demo -->
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <a class="{{ $className }}" href="{{ url($link->link . $link->sufix) }}">{{ $link->title}}</a>
            @endif
        </div>
    @endforeach
</nav>