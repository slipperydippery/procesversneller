@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<h1>Overzicht scans</h1>
			<p>this will be a vue page, with each scan as a row</p>
			<ul>
				@foreach($scans as $scan)
					<li> <a href=" {{ route('scan.show', $scan) }} ">{{ $scan->title }}</a> </li>
					<ul>
						<li>edit name</li>
						<li>see group</li>
						<li>see progress</li>
						<li></li>
						<li>start scan -></li>
					</ul>
				@endforeach
				<li>New Scan</li>
			</ul>
        </div>
    </div>
</div>
@endsection
