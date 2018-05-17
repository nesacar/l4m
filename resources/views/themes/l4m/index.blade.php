<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @yield('title')
  <link href="https://fonts.googleapis.com/css?family=Lora&amp;subset=latin-ext" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&amp;subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('themes/' . $theme . '/css/main.css') }}">
  @yield('seo')
  @yield('styles')
</head>
<body>
  @include('themes.'. $theme . '.partials.mobile-nav')
  @include('themes.' . $theme . '.partials.graphics')
  @include('themes.' . $theme . '.partials.header')

  <div class="content">
    @yield('content')
  </div>

  @include('themes.' . $theme . '.partials.footer')

  <script src="{{ url('themes/' . $theme . '/js/index.js')}}"></script>

  <script>
    window.app_url = "{{ url('/') }}";
    window.cartItems = {!! \App\ShoppingCart::getIds() !!};
  </script>
  @yield('scripts')
  @if(session('message'))
    <script>
      Toast.create('{{ session('message')  }}');
    </script>
  @endif
</body>
</html>