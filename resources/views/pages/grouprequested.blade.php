@extends('layouts.app')

@section('content')
    <div class="container container--page">
        <div class="row">
            <div class="col-md-12">
                <span class="breadcrumb"> <a href=" {{ route('home') }} ">Dashboard</a> > Scan aangemaakt </span>
                <h1 class="section--title"> Verzoek verstuurd  </h1>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<h2 class="page--title"> Verzoek verstuurd </h2>
                <span class="page--clarification">Jouw scan is aangemaakt, en er is een verzoek naar de beheerder van de groep gestuurd. Zodra jouw verzoek in behandeling is genomen door de beheerder krijg je hier melding van. Maar je kunt alvast aan de slag met je scan!</span>
        	</div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 ">
                <a href="/home" class="btn btn--fullwidth">Naar je dashboard</a>
            </div>
        </div>
    </div>
@endsection
