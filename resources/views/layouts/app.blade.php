<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SAPS Circulation</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="{{asset('css/toastr.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-info">
@include('includes.header')
    <div id="app">


        <div class="container">

            @yield('content')
        </div>

    </div>
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('js/toastr.min.js') }}" ></script>
@yield('scripts')
<script>
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @endif

</script>
</body>
</html>
