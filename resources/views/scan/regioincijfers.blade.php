@extends('layouts.appscan')
@section('title', 'Regio in Cijfers')

@section('hintsmodal')
    <hintsmodal
        :active="true"
        :messages=" [
            'Ga met je muis over een regio om de NEET-rate per arbeidsregio te bekijken.',

            'Met de drie knoppen onderin kun een eigen selectie maken.',

            'Wil je een toelichting over de NEET-rate, klik dan op de (i) knop onderin.'
        ] "
        :loggedin=" {{ Auth::guest() ? 0 : Auth::user() }} "
    >
    </hintsmodal>
@endsection

@section('content')
    <div class="row">
    	<div class="col-md-12">
            <h2 class="page--title"> Uw regio in cijfers </h2>
            @if($scan->group)
                <span class="page--clarification">Selecteer een arbeidsregio om te zien hoe verschillende factoren de NEET-rate beinvloeden. Bespreek met elkaar wat jullie opvalt. Als er geen kaart verschijnt, volg dan <a href="https://monitoraoj.nl/arbeidsregio1" target="_blank">deze link</a>.</span>
            @else
        		<span class="page--clarification">Selecteer een arbeidsregio om te zien hoe verschillende factoren de NEET-rate beinvloeden. Als er geen kaart verschijnt, volg dan <a href="https://monitoraoj.nl/arbeidsregio1" target="_blank">deze link</a>.</span>
            @endif
    	</div>
    </div>
    <div class="row content--page">
    	<div class="col-sm-12">
            <iframe scrolling="no" 
                src="https://monitoraoj.nl/arbeidsregio1/#primary" 
                style="border: 0px none; height: 1300px; width: 1180px;"
                class="iframe--monitor"
            > 
            </iframe>
    	</div>
    </div>
    <div class="prev-next-nav">
        @if($scan->group)
            <a href=" {{ route('scan.kennismaken', $scan) }} " class="btn prev-next-nav--prev">
                << vorige scherm
            </a>
        @else
        	<a href=" {{ route('scan.show', $scan) }} " class="btn prev-next-nav--prev">
        		<< vorige scherm
        	</a>
        @endif
    	<a href=" {{ route('scan.algemeenbeeld', $scan) }} " class="btn prev-next-nav--next">
    		volgende scherm >>
    	</a>
    </div>
    
    <scan-progress
        :scanmodel="{{ App\Scanmodel::with('themes.questions')->find($scan->scanmodel->id) }}"
        :workscan=" {{ $scan }} "
        :page="'regioincijfers'"
        >
    </scan-progress>
@endsection
