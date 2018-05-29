@extends('layouts.appscan')
@section('title', 'Introductie')

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		<h2 class="page--title"> De scan is afgerond </h2>
            <span class="page--clarification">Je hebt alle vragen al beantwoord. Je kunt jezelf een overzicht van de actiepunten mailen, of naar een overzicht van alle resultaten gaan. Maak gezamenlijk een afspraak om de actiepunten uit te werken naar een werkagenda. </span>
    	</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <br><br>
            <a href=" {{ route('scan.emailresults', $scan) }} " class="btn btn--fullwidth">Email mij de actiepunten</a> <br> <br>
            <a href=" {{ route('scan.results', $scan) }} " class="btn btn--fullwidth btn--secondary">Bekijk alleen de resultaten</a> <br> <br>
            <a href=" {{ route('scan.measureresults', $scan) }} " class="btn btn--fullwidth">Bekijk de actiepunten</a> <br><br>
            <a href=" {{ route('scan.startscan', $scan) }} " class="btn btn--fullwidth btn--tertiary">Doe de scan opnieuw</a>
        </div>
    </div>

@endsection
