@extends('layouts.appscancontainer')
@section('title', '15 vragen over 3 themas')

@section('hintsmodal')
    <hintsmodal
        :active=" false "
        :messages=" [

        ] "
        :loggedin=" {{ Auth::guest() ? 0 : Auth::user() }} "
    >
    </hintsmodal>
@endsection

@section('content')

	<scan-container
		:workscan=" {{ $scan }} "
		:scanmodel=" {{ $scanmodel }} "
        :loggedin=" {{ Auth::guest() ? 0 : Auth::user() }} "
	>
	</scan-container>

@endsection
