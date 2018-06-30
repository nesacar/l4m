<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="domain" content="{{ url('/') }}">

    <title>Luxury4.me</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <top-bar></top-bar>
    <right-bar></right-bar>
    <left-bar></left-bar>

    <router-view></router-view>

    <footer>
        <p>Developed by Mini STUDIO Publishing Group</p>
    </footer>
</div>

<!-- Scripts -->
{{--<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>--}}
<script src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>