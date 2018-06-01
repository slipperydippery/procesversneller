<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Procesversneller - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href=" {{ asset('img/favicon.ico') }} ">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-93563705-6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-93563705-6');
    </script>

</head>
<body>
    <div id="app">
        @include('partials.nav')
        @yield('content')
        <footer class="footer">
            <div class="container">
                <span class="text-muted">De Procesversneller is ontwikkeld in opdracht van ... Concept programmering en uitvoering door EMB AV &copy; </span>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.js"></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>   
    <script>
       window.Laravel = {!! json_encode([
           'csrfToken' => csrf_token(),
       ]) !!};
   </script>
        
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
