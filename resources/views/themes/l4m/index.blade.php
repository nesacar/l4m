<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Luxury4Me</title>
  <link rel="stylesheet" href="{{ url('/themes/l4m/css/main.css') }}">
</head>
<body>
  
  <div class="content">

    @yield('content')

  </div>
  
  @include('themes/l4m/partials/footer')

  <script src="{{ url('themes/l4m/js/index.js')}}"></script>
</body>
</html>