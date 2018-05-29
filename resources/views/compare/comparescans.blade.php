@extends('layouts.appcms')

@section('hintsmodal')

    <hintsmodal
        :active=" true "
        :messages=" [
            'Hieronder zie je de scans die je hebt gemaakt. Elke scan kun je vergelijken met scans van andere deelnemers. Klik op het rode kruisje om een scan te selecteren. Je kunt een of meerdere scans selecteren. Wanneer je selectie compleet is klik je op de knop “vergelijk scans”.', 
            
            'Wil je gezamenlijk werken aan verbeterpunten en acties? Maak dan een groepsscan aan op je dashboarden nodig jouw netwerkpartners uit om de scan samen aan tafel te doen. Op die manier kun je werken aan gerichte oplossingen.'
        ] "
        :loggedin=" {{ Auth::guest() ? 0 : Auth::user() }} "
    >
    </hintsmodal>
@endsection

@section('content')

    <div class="container container--page">
        <div class="row">
            <div class="col-sm-12">
                <span class="breadcrumb"> <a href=" {{ route('home') }} ">Dashboard</a> > vergelijk scans </span>
            </div>
        </div>
        <comparemanager
        	:user=" {{ Auth::user() }} "	
        	:districts=" {{ $districts }} "
            :instanties=" {{ $instanties }} "
        >
        </comparemanager>
    </div>

@endsection
