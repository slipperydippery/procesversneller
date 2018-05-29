@extends('layouts.appcms')

@section('content')
<div class="container container--page">
    <div class="row">
        <div class="col-sm-12 page--head">
            <h2>Je scan is aangemaakt!</h2>
            <h3>Je scan is aangemaakt. 
                <?php if($grouprequest == true) {
                    echo('Er is een bericht naar de groepsbeheerder gestuurd. Zodra je bent geaccepteerd krijg je daarvan een melding.');
                } ?> 
            Je kunt de scan meteen bekijken, of op een later tijdstip terugkomen.</h3>

        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <a href=" {{ route('scan.show', $scan) }} " class="btn btn-primary btn--fullwidth">
                        start de scan nu
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href=" {{ route('home') }} " class="btn btn--secondary btn--fullwidth">
                        naar je dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
