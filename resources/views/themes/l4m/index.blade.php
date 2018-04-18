<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ url('themes/' . env('THEME_NAME', '') . '/css/main.css') }}">
</head>
<body>
  @include('themes.' . env('THEME_NAME', '') . '.partials.graphics')
  @include('themes.' . env('THEME_NAME', '') . '.partials.header')

  <div class="content">

    @yield('content')

  </div>

  @include('themes.' . env('THEME_NAME','') . '.partials.footer')

  <script src="{{ url('themes/' . env('THEME_NAME', '') . '/js/index.js')}}"></script>
</body>
</html>