<p>Je hebt succesvol meegedaan aan de participatiescan met groep {{ $scan->title }}:</p>
<p>Dit zijn de verbeteracties die jullie hebben besproken (per thema):</p>
@foreach($scan->measures as $measure)
	@if($measure->active)
		<h3>{{ $measure->question->theme->title }}: {{ $measure->question->title }}</h3>
		@php
		    $name = 'Er is geen trekker geslecteerd';
		    if($measure->users->first()){
		        $name = $measure->users->first()->name;
		    }
		@endphp
		<h6> TREKKER: {{ $name }} </h6>
		<h6> ACTIEPUNT: </h6>
		<span> {{ $measure->measure }} </span>
	@endif

@endforeach

@if($scan->scandate)
	<p>Op {{ $scan->followup->date }} om {{ $scan->followup->time }} is een bijeenkomst gepland om de uitgevoerde actiepunten om te zetten naar een werkagenda. </p>
@else
	<p>Er is nog geen datum gepland om de uitgevoerde actiepunten om te zetten naar een werkagenda.</p>
@endif

<p>Je kunt de scan natuurlijk ook bekijken via jouw account.</p>