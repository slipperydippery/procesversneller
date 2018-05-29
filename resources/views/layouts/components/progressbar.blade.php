
<div class="row progressbar">
    <a href=" {{ route('scan.show', $scan) }} " class="progressbar--element <?= ($active == 'start') ? 'active' : '' ?>" title="Introductie">
        <div>
            <img src="/img/play.svg" alt="">
        </div>
    </a>
    @if(Auth::check())
        @if(count($scan->group))
            <a href=" {{ route('scan.kennismaken', $scan) }} " class="progressbar--element  <?= ($active == 'kennismaken') ? 'active' : '' ?>" title="Kennismaken">
                <div>
                    <img src="/img/group.svg" alt="">
                </div>
            </a>
        @endif
    @endif
    <a href=" {{ route('scan.regioincijfers', $scan) }} " class="progressbar--element  <?= ($active == 'regioincijfers') ? 'active' : '' ?>" title="Uw regio in cijfers">
        <div>
            <img src="/img/nederland-square.svg" alt="">
        </div>
    </a>
    <a href=" {{ route('scan.algemeenbeeld', $scan) }} " class="progressbar--element  <?= ($active == 'algemeenbeeld') ? 'active' : '' ?>" title="Beoordeel de huidige gezamenlijke aanpak">
        <div>
            <img src="/img/eye.svg" alt="">
        </div>
    </a>
    <a href=" {{ route('scan.algemeenbeeldresultaten', $scan) }} " class="progressbar--element  <?= ($active == 'algemeenbeeldresultaten') ? 'active' : '' ?>" title="Algemeen beeld resultaten.">
        <div>
            <img src="/img/checkmark.svg" alt="">
        </div>
    </a>
    <a href=" {{ route('scan.showscan', $scan) }} " class="progressbar--element" title="15 vragen over 3 themas">
        <div>
            <img src="/img/scoreboard.svg" alt="">
        </div>
    </a>
</div>

