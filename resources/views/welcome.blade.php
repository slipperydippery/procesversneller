@extends('layouts.app')

@section('content')
    <div class="content content--welcome">
        <section class="content--abovethefold">
            <div class="row container">
                <h1 class="title"><span class="title--participatie">Participatie</span><span class="title--dot">.</span><span class="title--scan">scan</span></h1>
                <h2 class="subtitle">Een analyse- en actietool om te komen tot heldere regionale afspraken en een effectieve samenwerking voor het naar werk begeleiden van jongeren in een kwetsbare positie. Alles wat netwerkpartners nodig hebben om succesvol de handen ineen te slaan.</h2>
                <div class="featuredimg--container">
                    <img src="/img/jongeren.svg" alt="" class="featuredimg">
                    <div class="mainbutton--container">
                        <a href=" {{ route('startscan') }} " class="btn mainbutton">Bekijk de scan</a>
                        <a href="/pdf/handleiding_participatiescan.pdf"><span class="fineprint fineprint--welcome">Lees hier hoe de scan werkt</span></a>
                    </div>
                </div>
            </div>
        </section>
        

        <section class="">
            <div class="row container">
                <div class="col-sm-4">
                    <a href=" {{ route('instructiefilms') }} ">
                        <div class="infoblock">
                            <h4>Instructiefilms</h4>
                            <img src="/img/movie.svg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href=" {{ route('kennisbank') }} ">
                        <div class="infoblock">
                            <h4>Kennisbank</h4>
                            <img src="/img/books.svg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href=" {{ route('pmonitor') }} ">
                        <div class="infoblock">
                            <h4>Cijfers uit jouw regio</h4>
                            <img src="/img/nederland.svg" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section>
            <div class="row container welcome--textblock--container">
                <div class="col-sm-4 welcome--textblock">
                    <h3>Betere kansen voor jongeren</h3>
                    <span>Met deze Participatiescan kun je als leidinggevende of beleidsmaker samen met netwerkpartners werken aan een succesvolle aanpak om jongeren in een kwetsbare positie naar werk te begeleiden. De scan helpt je om de regionale aanpak te verbeteren aan de hand van 15 bewezen succesfactoren.</span>
                </div>
                <div class="col-sm-4 welcome--textblock">
                    <h3>15 Succesfactoren</h3>
                    <span>Hoe ziet de optimale weg van school naar werk van jongeren in een kwetsbare positie eruit? Daarover weten we via onderzoek heel veel. Met deze scan zet je kennis om in actie en kun je een effectieve, gezamenlijke aanpak ontwikkelen. Toepassing van succesfactoren: het kan vaak zoveel beter! </span>
                </div>
                <div class="col-sm-4 welcome--textblock">
                    <h3>Gezamenlijk aan tafel</h3>
                    <span>Maak een account aan en nodig 12 netwerkpartners uit voor een gezamenlijke analyse en verbeteragenda. De Participatiescan neemt je daarin mee. Bespreek de resultaten met elkaar aan tafel. Je kunt ook eerst zelf aan de slag of online jouw dashboard met andere deelnemers vergelijken.</span>
                </div>
            </div>
        </section>
    </div>
@endsection


