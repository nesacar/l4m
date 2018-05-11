@extends('themes.' . $theme . '.index')

@section('seo')

@endsection

@section('content')
    <div class="container">
        <div class="row">

            @if(!empty($data))
                <ul class="list-item">
                    @foreach($data->items as $key => $item)
                        <li class="list-group-item">{{ dd($item) }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection