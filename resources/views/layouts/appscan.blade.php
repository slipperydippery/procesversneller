<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Participatiescan - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://vjs.zencdn.net/5.17.0/video-js.css" rel="stylesheet">
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
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Participatie.scan
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Functional links -->
                        @guest
                        @else
                            <li><a href=" {{ route('home') }} " title="Naar je dashboard"><img src="/img/dashboard.svg" alt=""></a></li>
                            <li>
                                <turnonhints
                                    :user=" {{ Auth::user() }} "    
                                    title="Hints aanzetten"
                                >
                                </turnonhints>
                            </li>
                            <li>
                                <span class="clickable navitem warning" v-if=" ! showdeletescan " @click="showdeletescan = true" title="Verwijder scan">&#10006;</span>
                                <span class="navitem" v-if="showdeletescan">
                                    Weet je zeker dat je de scan wilt verwijderen? 
                                    <a href=" {{ route('scan.selfdestruct', $scan) }} " class="warning">Ja</a> 
                                    <span @click="showdeletescan = false" class="clickable accept">nee</span>
                                </span>
                            </li>
                        @endguest
                        <li><a href=" {{ route('contact') }} "><img src="/img/contact.svg" alt="" title="Contact"></a></li>
                        <li><a href="/pdf/handleiding_participatiescan.pdf"><img src="/img/manual2.svg" alt="" title="Instructie"></a></li>
                        <li><a href="
                            mailto:?Subject=Tip%3A%20Participatiescan.com&Body=Heb%20je%20beroepsmatig%20te%20maken%20met%20jongeren%20in%20een%20kwetsbare%20positie%3F%0ADan%20is%3A%20www.participatiescan.com%20echt%20een%20aanrader%21%20Een%20netwerktool%20om%20samen%20aan%20tafel%20of%20zelfstandig%20een%20analyse%20te%20maken%20en%20te%20komen%20tot%20een%20effectieve%20samenwerking%20voor%20het%20naar%20werk%20begeleiden%20van%20jongeren%20in%20een%20kwetsbare%20positie.
                        "><img src="/img/share.svg" alt="" title="Deel deze pagina met je netwerkpartners"></a></li>
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Log in</a></li>
                            <li><a href="{{ route('register') }}">Maak een account aan</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('hintsmodal')
        
        <div class="container container--page">
            <div class="row">
                <div class="col-md-12">
                    @if($scan->group)
                        <span class="breadcrumb"> 
                            Arbeidsmarktregios: 
                            @foreach($scan->group->owner->districts as $district)
                                {{ $district->title }} -
                            @endforeach
                         </span>
                        <h1 class="section--title"> Groepsscan: {{ $scan->group->owner->title }} </h1>
                    @else
                        <span class="breadcrumb"> 
                            Arbeidsmarktregios: 
                            @foreach($scan->districts as $district)
                                {{ $district->title }} -
                            @endforeach
                         </span>
                        <h1 class="section--title"> {{ $scan->title }} </h1>

                    @endif
                </div>
            </div>
            
            @yield('content')

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.js"></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>   
    <script>
       window.Laravel = {!! json_encode([
           'csrfToken' => csrf_token(),
       ]) !!};
   </script>
    
    <script src="https://vjs.zencdn.net/5.17.0/video.js"></script>        
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('additional-scripts')
</body>
</html>
