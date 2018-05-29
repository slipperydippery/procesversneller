@extends('layouts.appscan')
@section('title', 'Introductie')

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		<h2 class="page--title"> Overzicht van alle Actiepunten </h2>
            <span class="page--clarification">Hier is een overzicht van alle actiepunten.</span>
    	</div>
    </div>
    <div class="row">
        <div class="col-sm-12">    
            @if($scan->followup)
                <p class="scandate">op {{ $scan->followup->date }} om {{ $scan->followup->time }} is een bijeenkomst gepland om de uitgevoerde actiepunten om te zetten naar een werkagenda </p>
            @else
                <p class="scandate">Er is nog geen datum gepland om de uitgevoerde actiepunten om te zetten naar een werkagenda</p>
            @endif

            @foreach($measurescan->measures as $measure)
                @if($measure->active)
                    <div class="infoblock">
                        <h4> {{ $measure->question->theme->title }}: {{$measure->question->title}}</h4>
                        @php
                            $name = 'Er is geen trekker geslecteerd';
                            if($measure->users->first()){
                                $name = $measure->users->first()->name;
                            }
                        @endphp
                        <h6> TREKKER: {{ $name }} </h6>
                        <h6> ACTIEPUNT: </h6>
                        <span> {{ $measure->measure }} </span>
                    </div>
                @endif
            @endforeach
    </div>

@endsection
