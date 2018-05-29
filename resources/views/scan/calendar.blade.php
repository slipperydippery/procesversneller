@extends('layouts.appscan')
@section('title', 'Introductie')

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		<h2 class="page--title"> De scan is afgerond </h2>
            <span class="page--clarification">Je hebt alle vragen al beantwoord. We adviseren om nu alvast een vervolgafspraak te maken om de uitgevoerde actiepunten om te zetten naar een werkagenda. De beheerder kan op de kalender een datum prikken zodat deze afspraak naar alle deelnemers van de groep kan worden gemaild. </span>
    	</div>
    </div>

    @if($scan->followup)
        <p  class="scandate">Er is een vervolgafspraak gepland op: {{ $scan->followup->date }} om {{ $scan->followup->time }}.</p>
    @else
        <p  class="scandate">Er is nog geen vervolgafspraak gepland</p>
    @endif

    @if($scan->id == $scan->group->owner->id)
        {!! Form::open(['route' => ['scan.commitdatetime', $scan->id]]) !!}
            <div class="col-sm-8 date__container">
                <div class="col-sm-12 ">
                    @if($scan->followup)
                       <label for="datepicker"><h4> Kies een andere daum: </h4></label>
                   @else
                       <label for="datepicker"><h4> Plan een vervolgdatum voor het maken van de werkagenda. </h4></label>
                   @endif
               </div>
            
                <div class="col-sm-6 ">
                    @if ($errors->has('date'))
                         <div class="alert alert-danger">
                            <strong> Incompleet: </strong>Datum is verplicht
                         </div>
                    @endif
                    <input id="date" class="hidden" name="date" type="text" placeholder="Choose a date">
                </div>
                <div class="col-sm-6 ">
                   @if ($errors->has('time'))
                        <div class="alert alert-danger">
                           <strong> Incompleet: </strong>Tijd is verplicht
                        </div>
                   @endif
                    <!-- Tijd Form Input -->
                    <div class="form-group">
                        <input id="time" class="hidden" type="time" name="time">
                    </div>
                </div>

            </div>

            <div class="col-sm-12 thema-submit-container">
                <!-- Add Submit Field -->
                <div class="form-group">
                    {!! Form::submit('Datum opslaan', ['class' => 'btn']) !!}
                    @if($scan->followup)
                        <a href=" {{ URL::route('scan.complete', $scan) }}"  class="btn btn--secondary" > Geen nieuwe datum opslaan</a>
                   @else
                        <a href=" {{ URL::route('scan.complete', $scan) }}"  class="btn btn--secondary" > Geen datum opslaan</a>
                   @endif
                </div>
            </div>  
        {!! Form::close() !!}
    @else
        <a href=" {{ URL::route('scan.complete', $scan) }}"  class="btn" >Rond de scan af</a>
    @endif
@endsection

@section('additional-scripts')    
    <script src="{{ URL::asset('/js/picker.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.date.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.time.js') }}"></script>

    <script>
      $(function() {
        // Enable Pickadate on an input field
        $('#time').pickatime({
            formatSubmit: 'HH:i',
            hiddenName: true
        });
        $('#date').pickadate({
            monthsFull: [ 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' ],
            monthsShort: [ 'jan', 'feb', 'maa', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec' ],
            weekdaysFull: [ 'zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag' ],
            weekdaysShort: [ 'zo', 'ma', 'di', 'wo', 'do', 'vr', 'za' ],
            formatSubmit: 'yyyy/mm/dd',
            hiddenName: true,
            close: ''
        });
      });   
    </script>
    <script>
        function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = 0;
            }
        }, 1000);
    }

    window.onload = function () {
        var fifteenMinutes = 60 * 15,
            display = document.querySelector('#time');
        startTimer(fifteenMinutes, display);
    };
    </script>

@stop
