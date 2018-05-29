@extends('layouts.appscan')
@section('title', 'Scan Resultaten')

@section('content')

	<results-container
		:workscan=" {{ $scan }} "
		:scanmodel=" {{ $scanmodel }} "
		:loggedin=" true "
	>
	</results-container>

@endsection
