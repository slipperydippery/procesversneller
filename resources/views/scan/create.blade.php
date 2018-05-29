@extends('layouts.appcms')

@section('hintsmodal')
    <?php 
        $loggedin = Auth::guest() ? 0 : Auth::user();
    ?>

    <hintsmodal
        :active=" {{ $loggedin ? $loggedin->hints : false }} "
        :messages=" [
            'Maak een nieuwe scan aan als je zelf een scan wilt doen of als je een scan wilt koppelen aan een bestaande groepsscan.'
        ] "
        :loggedin=" {{ $loggedin }} "
    >
    </hintsmodal>
@endsection

@section('content')
<div class="container container--page">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<h1>Maak een nieuwe scan aan:</h1>
        	<create-scan
        		:instanties=" {{ $instanties }} "
        		:groups=" {{ $groups }} "
        		:alldistricts=" {{ $districts }} "
        	>
        	</create-scan>
        </div>
    </div>
</div>
@endsection
