@extends('layouts.appscan')
@section('title', 'Algemeen beeld resultaten')

@section('hintsmodal')

    <hintsmodal
        :active="true"
        :messages=" [
            'Hier zie je jouw ingevulde resultaat en de resultaten van andere deelnemers als je een groepsscan doet, of als je de scan vergelijkt met anderen.'
        ] "
        :loggedin=" {{ Auth::guest() ? 0 : Auth::user() }} "
    >
    </hintsmodal>
@endsection

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		<h2 class="page--title"> Algemeen beeld resultaten</h2>

            @if($scan->group)
                <span class="page--clarification"> Niet om te bespreken, maar wel om alvast met elkaar te delen: wat is ons gevoel bij hoe we het in algemene zin doen in onze regio? </span>
            @elseif(Auth::guest())
                <span class="page--clarification"> Met een account kun je hier de score zien die je hebt ingevuld en jouw antwoord vergelijken met de groep of andere individuele scans. </span>
            @else
        		<span class="page--clarification"> Dit is het antwoord dat je gegeven hebt. Via het dashboard kun je jouw antwoorden vergelijken met andere deelnemers. </span>
            @endif
            
    	</div>
    </div>
    <algemeenbeeldresultaten
        :workscan=" {{ $scan }} "
        :scanmodel=" {{ $scanmodel }} "
        :loggedin=" {{ Auth::guest() ? 0 : Auth::user() }} "
    >
    </algemeenbeeldresultaten>
    <div class="prev-next-nav">
    	<a href=" {{ route('scan.algemeenbeeld', $scan ) }} " class="btn prev-next-nav--prev">
    		<< vorige scherm
    	</a>
    	<a href=" {{ route('scan.showscan', $scan) }} " class="btn prev-next-nav--next">
    		volgende scherm >>
    	</a>
    </div>
    
    <scan-progress
        :scanmodel="{{ App\Scanmodel::with('themes.questions')->find($scan->scanmodel->id) }}"
        :workscan=" {{ $scan }} "
        :page="'algemeenbeeldresultaten'"
        >
    </scan-progress>
@endsection
