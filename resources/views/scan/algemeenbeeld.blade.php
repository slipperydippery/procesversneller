@extends('layouts.appscan')
@section('title', 'Beoordeel de huidige gezamenlijke aanpak')

@section('content')

    <div class="row">
    	<div class="col-md-12">
    		<h2 class="page--title"> Beoordeel de huidige gezamenlijke aanpak </h2>
    		<span class="page--clarification"> Kunt u een algemene indruk geven van hoe goed uw regio het volgens u doet als het gaat om het gezamenlijk goed begeleiden van jongeren in een kwetsbare positie van school naar werk. Nul is ‘heel slecht’  en tien is ‘perfect’ </span>
    	</div>
    </div>

    <countdown date="60"></countdown>

    <?php 
        $loggedin = Auth::guest() ? 0 : 1;
    ?>
    <div class="row content--page">
    	<div class="col-sm-12">
            <algemeenbeeld :workscan=" {{ $scan }} " :loggedin=" {{ $loggedin }} "></algemeenbeeld>
    	</div>
    </div>
    <div class="prev-next-nav">
    	<a href=" {{ route('scan.regioincijfers', $scan) }} " class="btn prev-next-nav--prev">
    		<< vorige scherm
    	</a>
    	<a href=" {{ route('scan.algemeenbeeldresultaten', $scan) }} " class="btn prev-next-nav--next">
    		volgende scherm >>
    	</a>
    </div>
    
    <scan-progress
        :scanmodel="{{ App\Scanmodel::with('themes.questions')->find($scan->scanmodel->id) }}"
        :workscan=" {{ $scan }} "
        :page="'algemeenbeeld'"
        >
    </scan-progress>
@endsection
