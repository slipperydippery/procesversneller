@extends('layouts.appscan')
@section('title', 'Introductie')

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		<h2 class="page--title"> De actiepunten zijn naar je gemaild </h2>
            <span class="page--clarification">De actiepunten van de Participatiescan zijn naar je gemaild. Vanaf hier kun je de resultaten bekijken, de scan opnieuw doorlopen, of terug naar je dashboard. </span>
    	</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <br><br>
            <a href=" {{ route('scan.results', $scan) }} " class="btn btn--fullwidth ">Bekijk de resultaten</a> <br> <br>
            <a href=" {{ route('scan.startscan', $scan) }} " class="btn btn--fullwidth btn--secondary">Doe de scan opnieuw</a> <br> <br>
            <a href=" {{ route('scan.measureresults', $scan) }} " class="btn btn--fullwidth">Bekijk de actiepunten</a> <br><br>
            <a href=" {{ route('home', $scan) }} " class="btn btn--fullwidth btn--tertiary">Naar je dashboard</a>
        </div>
    </div>

@endsection
