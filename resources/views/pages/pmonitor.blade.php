@extends('layouts.app')

@section('content')
    <div class="container container--page">
        <div class="row">
            <div class="col-md-12">
                <span class="breadcrumb"> <a href=" {{ route('home') }} ">Dashboard</a> > cijfers uit jouw regio </span>
                <h1 class="section--title"> Cijfers uit jouw regio </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="page--title"> Participatiemonitor </h2>
                <span class="page--clarification">De cijfers die hier worden weergegeven geven aan welke factoren in de geschiedenis van een jongere hem of haar extra kwetsbaar maken om zonder werk en school te raken. Deze data en kennis over effectieve arbeidstoeleiding van de doelgroep leveren input voor een gesprek waarin kennis, reflectie en actie op tactisch niveau gecombineerd worden. Klik op de "i" voor een uitgebreide toelichting. Als er geen kaart verschijnt, volg dan <a href="https://monitoraoj.nl/arbeidsregio1" target="_blank">deze link</a>. </span>

            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12">
                <iframe
                    src="https://monitoraoj.nl/arbeidsregio1/#primary" 
                    style="border: 0px none; height: 763px; width: 1200px;"
                    class="iframe--monitor"
                > 
                </iframe>
            </div>
        </div>
    </div>
@endsection
