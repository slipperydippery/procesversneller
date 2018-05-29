@extends('layouts.appcms')

@section('hintsmodal')
    <?php 
        $loggedin = Auth::guest() ? 0 : Auth::user();
    ?>

    <hintsmodal
        :active=" {{ $loggedin ? $loggedin->hints : false }} "
        :messages=" [
            'Dit is jouw persoonlijke dashboard. Als je een nieuwe scan aanmaakt, kun je deze meteen of later uitvoeren. Heb je de scan gemaakt? Dan kun je jouw resultaten altijd via het dashboard bekijken of vergelijken met anderen die de scan hebben gemaakt.',

            'Wil je de scan gezamenlijk met netwerkpartners doen? Maak dan een groepsscan aan. Als je de groepsscan hebt aangemaakt, kunnen andere deelnemers hun eigen scan aan jouw groepsscan koppelen. Je krijgt daarvan bericht op het dashboard. Je kunt deelnemers accepteren of verwijderen. Alleen de deelnemers die je accepteert, kunnen meedoen aan jouw groepsscan.',

            'Via dit dashboard heb je altijd toegang tot de kennisbank; een bibliotheek vol links en praktijkvoorbeelden.', 

            'Via dit dashboard heb je altijd actuele cijfers uit jouw regio over jongeren in een kwetsbare positie. Deze cijfers zijn handig bij het ontwikkelen van beleid of voor het direct ontwikkelen van acties voor een bepaalde doelgroep.'

        ] "
        :loggedin=" {{ $loggedin }} "
    >
    </hintsmodal>
@endsection

@section('content')
<div class="container container--page">
    <div class="row">
        <div class="col-md-12">
            <div class="page--title">
                <h1 class="pagetitle">Dashboard</h1>
            </div>
        </div>
    </div>
        <dashmessages :user="{{ $user }}"></dashmessages>
    <div class="row">
        <div class="col-md-4 dashboard--column">
            <a href=" {{ route('scan.create') }} " title="Doe individueel een scan">
                <div class="dashboard--item">
                    <div class="dashboard--item--head">Nieuwe scan</div>
                    <div class="dashboard--item--body"><img src="/img/newscan.svg" alt=""></div>
                </div>
            </a>
            <a href=" {{ route('group.create') }} " title="Doe de scan samen met een groep">
                <div class="dashboard--item">
                    <div class="dashboard--item--head">Nieuwe groep</div>
                    <div class="dashboard--item--body"><img src="/img/newgroup.svg" alt=""></div>
                </div>
            </a>
            <a href=" {{ route('instructiefilms') }} ">
                <div class="dashboard--item" title="De participatiescan in beeld">
                    <div class="dashboard--item--head">Instructiefilms</div>
                    <div class="dashboard--item--body"><img src="/img/movie.svg" alt=""></div>
                </div>
            </a> 
        </div>
        <div class="col-md-4 dashboard--column">
            <div class="dashboard--item" title="Beheer je scans">
                <div class="dashboard--item--head">Mijn scans</div>
                <div class="dashboard--item--body autoscroll">
                    @foreach($user->scans as $scan)
                        @if(! $scan->owns)
                            <?php 
                                $answercount = 0;
                                foreach($scan->answers as $answer) {
                                    if ($answer->answer != null) {
                                        $answercount++;
                                    }
                                }
                            ?>
                            <div class="col-sm-12">
                                <div class="row no-overflow">
                                    <div class="col-sm-8">
                                        @if($scan->group)
                                            <a href=" {{ route('scan.show', $scan) }} "> {{ $scan->group->owner->title }}</a> 
                                        @else
                                            <a href=" {{ route('scan.show', $scan) }} "> {{ $scan->title }}</a> 
                                        @endif
                                    </div>
                                    <div class="col-sm-2" title=" <?= $answercount; ?> van de 15 vragen zijn beantwoord  "> <?= $answercount; ?>/15 </div>
                                    <div class="col-sm-2 rowicons"> 
                                        @if($scan->group)
                                            <img src="/img/group.svg" title="Deze scan is onderdeel van groep '{{ $scan->group->title }}'" class="rowicon">
                                        @endif
                                        @if($scan->grouprequest)
                                            <img src="/img/grouppending.svg" title="Een verzoek is naar group '{{ $scan->grouprequest->group->title }}' verzonden" class="rowicon">
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="dashboard--item dashboard--item--groups" title="Beheer je groepen">
                <div class="dashboard--item--head">Mijn groepen</div>
                <div class="dashboard--item--body">
                    @foreach($user->groups as $group)
                        <div class="row">
                            <div class="col-sm-7">
                                <a href=" {{ route('group.show', $group) }} ">{{ $group->title }}</a>
                            </div>
                            <div class="col-sm-3"> {{ $group->scans->count() }} </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <a href=" {{ route('kennisbank') }} ">
                <div class="dashboard--item" title="Inspirerende praktijkvoorbeelden, tools en links">
                    <div class="dashboard--item--head">Kennisbank</div>
                    <div class="dashboard--item--body"><img src="/img/books.svg" alt=""></div>
                </div>
            </a>
        </div>
        <div class="col-md-4 dashboard--column">
            <a href=" {{ route('comparescans') }} " title="Vergelijk jouw scan met andere deelnemers">
                <div class="dashboard--item">
                    <div class="dashboard--item--head">Scans vergelijken</div>
                    <div class="dashboard--item--body"><img src="/img/scales.svg" alt=""></div>
                </div>
            </a>
            <a href=" {{ route('pmonitor') }} ">
                <div class="dashboard--item dashboard--item--doubleheight" title="NEET-rate en risico's per arbeidsmarktregio">
                    <div class="dashboard--item--head">Cijfers uit jouw regio</div>
                    <div class="dashboard--item--body"><img src="/img/nederlandlarge.svg" alt=""></div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
