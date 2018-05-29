@extends('layouts.appscan')
@section('title', 'Kennismaken')

@section('content')

<div class="row">
	<div class="col-md-12">
		<h2 class="page--title"> Kennismaken </h2>
		<span class="page--clarification">Vaak zal niet iedereen elkaar kennen. Daarom een voorstelrondje, waarbij iedereen aangeeft: wie ben je, namens welke organisatie doe je mee, je rol/functie en wat je hoopt dat uit deze sessie komt (wens of droom).</span>
	</div>
</div>
<div class="row content--page">
	<div class="col-sm-12">
        <div class="row infoblock--container">
                <div class="col-sm-2 infoblock--colcontainer">
                    <div class="infoblock">
                            <span class="beheerder">beheerder</span>
                        @if($group->owner->user->isOnline())
                            <span class="logged logged--in">ingelogd</span>
                        @else
                            <span class="logged logged--out">uitgelogd</span>
                        @endif
                        <img src="/img/user.svg" alt="">
                        <div class="infoblock--padded">
                            <span class="infoblock--name">{{ $group->owner->user->name }}</span>
                            <span class="center infoblock--instantie"><strong> {{ $group->owner->instantie->title }} </strong></span>
                        </div>
                    </div>
                </div>

    		@foreach($scan->group->scans as $thisscan)
                 @if($thisscan->id != $group->owner->id)
                    <div class="col-sm-2 infoblock--colcontainer">
                        <div class="infoblock">
                            @if($thisscan->user->isOnline())
                                <span class="logged logged--in">ingelogd</span>
                            @else
                                <span class="logged logged--out">uitgelogd</span>
                            @endif
                            <img src="/img/user.svg" alt="">
                            <div class="infoblock--padded">
                                <span class="infoblock--name">{{ $thisscan->user->name }}</span>
                                <span class="center infoblock--instantie"><strong> {{ $thisscan->instantie->title }} </strong></span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            
        </div>
	</div>
</div>
<div class="prev-next-nav">
	<a href=" {{ route('scan.startscan', $scan) }} " class="btn prev-next-nav--prev">
		<< vorige scherm
	</a>
	<a href=" {{ route('scan.regioincijfers', $scan) }} " class="btn prev-next-nav--next">
		volgende scherm >>
	</a>
</div>
<scan-progress
    :scanmodel="{{ App\Scanmodel::with('themes.questions')->find($scan->scanmodel->id) }}"
    :workscan=" {{ $scan }} "
    :page="'kennismaken'"
    >
</scan-progress>
@endsection
