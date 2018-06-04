@extends('layouts.app')

@section('content')
    <div class="banner">
        <div class="container container--banner">
            <div class="curve"></div>
            <div class="siteinfo">
                <img class="printlogo" src="/img/logo.svg">
            </div>
        </div>
    </div>
    <div class="content content--welcome">
        <section class="content--abovethefold">
            <div class="row container">
                <h2 class="subtitle">Een analyse- en actietool om te komen tot heldere regionale afspraken en een effectieve samenwerking voor het naar werk begeleiden van jongeren in een kwetsbare positie. Alles wat netwerkpartners nodig hebben om succesvol de handen ineen te slaan.</h2>
                <div class="featuredimg--container">
                    <div class="mainbutton--container">
                        <a href=" {{ route('startscan') }} " class="btn mainbutton">Bekijk de scan</a>
                        <a href="/pdf/handleiding_participatiescan.pdf"><span class="fineprint fineprint--welcome">Lees hier hoe de scan werkt</span></a>
                    </div>
                </div>
            </div>
        </section>
        

        <div class="container segment segment--welcome">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src=".../100px180/" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
                <div class="row card-group">
                    <div class="col-sm-4">
                        <div class="card">
                            <img class="card-img-top" src="/img/forum.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Forum</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href=" # " class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <img class="card-img-top" src="/img/beslisboom.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Beslisboom</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <img class="card-img-top" src="/img/kennisbank.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Kennisbank</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection


