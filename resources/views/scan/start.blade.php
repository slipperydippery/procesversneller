@extends('layouts.appscan')
@section('title', 'Introductie')

@section('hintsmodal')

    <hintsmodal
        :active=" true "
        :messages=" [
            'Met de knoppen “vorige scherm”  en “ volgende scherm” kun je door de introductie bladeren. Je kunt de stappen ook selecteren in het menu onderaan. '
        ] "
        :loggedin=" {{ Auth::guest() ? 0 : Auth::user() }} "
    >
    </hintsmodal>
@endsection

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		<h2 class="page--title"> Introductiefilm </h2>
            @guest
                <span class="page--clarification">Bekijk de introductiefilm over wat en waarvoor de Participatiescan is. Of ga door naar het volgende scherm, als je de film of de sessiedeelnemers de film al hebben gezien. Tijdens een sessie kan de film gezamenlijk worden bekeken op het plenaire scherm. Klik <a href="https://www.youtube.com/watch?v=oOSoBnCPHlk">hier</a> als de video niet verschijnt.</span>
            @else
                @if($scan->group)
                    <span class="page--clarification">Bekijk de introductiefilm over het uitvoeren van de participatiescan of ga door naar het volgende scherm. We adviseren de film op een gezamenlijk scherm te bekijken. Klik <a href="https://www.youtube.com/watch?v=oOSoBnCPHlk">hier</a> als de video niet verschijnt. </span>
                @else
                    <span class="page--clarification">Bekijk de introductiefilm over het uitvoeren van de participatiescan of ga door naar het volgende scherm. Klik <a href="https://www.youtube.com/watch?v=oOSoBnCPHlk">hier</a> als de video niet verschijnt. </span>
                @endif
            @endguest
    	</div>
    </div>
    <div class="row content--page">
    	<div class="col-sm-12 youtube--container">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/oOSoBnCPHlk" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
        
        </div>
    </div>
    
    <div class="prev-next-nav">
        <a href=" {{ route('home') }} " class="btn prev-next-nav--prev">
            << dashboard
        </a>
        <a href=" {{ route('scan.kennismaken', $scan) }} " class="btn prev-next-nav--next">
            volgende scherm >>
        </a>
    </div>
    <scan-progress
        :scanmodel="{{ App\Scanmodel::with('themes.questions')->find($scan->scanmodel->id) }}"
        :workscan=" {{ $scan }} "
        :page="'start'"
        >
    </scan-progress>

@endsection
