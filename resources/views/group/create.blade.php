@extends('layouts.app')

@section('content')
<div class="container container--page">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<h1>Maak een nieuwe groep aan:</h1>
            <p>Wil je liever bij een groep aansluiten? <a href=" {{ URL::route('scan.create') }} ">Maak dan een scan aan</a>, en selecteer de groep waar je je bij aan wilt sluiten.</p>

        	<create-group
        		:instanties=" {{ $instanties }} "
        		:alldistricts=" {{ $districts }} "
        	>
        	</create-group>
        </div>
    </div>
</div>
@endsection
