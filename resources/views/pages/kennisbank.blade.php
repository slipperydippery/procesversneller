@extends('layouts.app')

@section('hintsmodal')
    <?php 
        $loggedin = Auth::guest() ? 0 : Auth::user();
    ?>

    <hintsmodal
        :active=" false "
        :messages=" [
            'Met de knoppen “vorige scherm”  en “ volgende scherm” kun je door de introductie bladeren. Je kunt de stappen ook selecteren in het menu onderaan. '
        ] "
        :loggedin=" {{ $loggedin }} "
    >
    </hintsmodal>
@endsection

@section('content')
    <div class="container container--page">
        <div class="row">
            <div class="col-md-12">
                <span class="breadcrumb"> <a href=" {{ route('home') }} ">Dashboard</a> > kennisbank </span>
                <h1 class="section--title"> kennisbank  </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="page--title"> Een weelde aan informatie </h2>
                <span class="page--clarification">Hieronder vindt u informatie over de succesfactoren voor het begeleiden van jongeren in een kwetsbare positie naar werk. Experts hebben aangegeven dat deze veelal ook gelden voor andere kwetsbare jongeren. Kijk gerust rond tussen de instrumenten/tools, programma’s en praktijkvoorbeelden. En zie hoe je via de opgenomen hyperlinks in contact komt met andere kennisbanken en inspirerende omgevingen, die scholen, gemeenten en partners ook op weg kunnen helpen om jongeren zo goed mogelijk een werkende toekomst te geven.</span>

            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12">
                <div id="exTab2" class="container kennisbank"> 
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a  href="#1" data-toggle="tab">Instrumenten</a>
                        </li>
                        <li>
                            <a href="#2" data-toggle="tab">Programma's</a>
                        </li>
                        <li>
                            <a href="#3" data-toggle="tab">Praktijkvoorbeelden</a>
                        </li>
                        <li>
                            <a href="#4" data-toggle="tab">PDFs</a>
                        </li>
                        <li>
                            <a href="http://werkhoezithet.nl/" target="_blank">werkhoezithet.nl</a>
                        </li>
                        <li>
                            <a href="#6" data-toggle="tab">Links</a>
                        </li>
                    </ul>

                    <div class="tab-content ">
                        <div class="tab-pane active" id="1">
                            <instrumenten></instrumenten>
                        </div>
                        <div class="tab-pane" id="2">
                            <programmas></programmas>
                        </div>
                        <div class="tab-pane" id="3">
                            <praktijkvoorbeelds></praktijkvoorbeelds>
                        </div>
                        <div class="tab-pane" id="4">
                            <pdfs></pdfs>
                        </div>
                        <div class="tab-pane" id="5">
                            <h3>add clearfix to tab-content (see the css)</h3>
                        </div>
                        <div class="tab-pane" id="6">
                            <links></links>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
