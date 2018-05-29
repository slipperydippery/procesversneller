@extends('layouts.app')

@section('content')
    <div class="container container--page">
        <div class="row">
            <div class="col-md-12">
                <span class="breadcrumb"> E-mail verificatie </span>
                <h1 class="section--title"> Geverifieerd  </h1>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<h2 class="page--title"> Geverifieerd </h2>
                <span class="page--clarification">Je hebt je e-mailadres geverifieerd. Klik hier om  <a href=" {{ url('/login') }} ">in te loggen</a></span>

        	</div>
        </div>
    </div>
@endsection
