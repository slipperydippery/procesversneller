@extends('layouts.app')

@section('content')
<div class="container container--page">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<h1>Maak een scan aan voor de groep {{ $group->title }}:</h1>
        	<create-groupscan
        		:instanties=" {{ $instanties }} "
        		:group=" {{ $group }} "
        	>
        	</create-groupscan>
        </div>
    </div>
</div>
@endsection
