@extends('layouts.app')

@section('content')
    <div class="container container--page">
        <div class="row">
            <div class="col-md-12">
                <span class="breadcrumb"> <a href=" {{ route('home') }} ">Dashboard</a> > instructiefilms </span>
                <h1 class="section--title"> Bekijk de instructiefilms  </h1>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<h2 class="page--title"> Instructiefilms </h2>
                <span class="page--clarification">Bekijk de instructiefilms over de Participatiescan. In de introductiefilm ziet u waarvoor de Participatiescan is. In de films "Focus op werk en talent", "Kwaliteit begeleiding", en "Effectieve samenwerking" ziet u per thema waar de vragen in de scan over gaan.</span>
        	</div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 ">
                <h4>Introductievideo</h4>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/oOSoBnCPHlk" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe> <br>
                <a href="https://www.youtube.com/watch?v=oOSoBnCPHlk">bekijk de video op youtube</a>
            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 ">
                <h4>Thema 1: Focus op werk en talent</h4>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/UjItL3RGbU0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe> <br>
                <a href="https://www.youtube.com/watch?v=UjItL3RGbU0">bekijk de video op youtube</a>
            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 ">
                <h4>Thema 2: Kwaliteit begeleiding</h4>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/BCd3b2NfnDM" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe> <br>
                <a href="https://www.youtube.com/watch?v=BCd3b2NfnDM">bekijk de video op youtube</a>
            </div>
        </div>
        <div class="row content--page">
            <div class="col-sm-12 ">
                <h4>Thema 3: Effectieve samenwerking</h4>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/tYNpt95zTWc" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe> <br>
                <a href="https://www.youtube.com/watch?v=tYNpt95zTWc">bekijk de video op youtube</a>
            </div>
        </div>
    </div>
@endsection
