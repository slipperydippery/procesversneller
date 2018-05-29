<!-- geef je groep een naam Form Input -->
<div class="form-group">
	{!! Form::label('title', 'geef je groep een naam:') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>


<!-- Welk instantie vertegenwoordig jij zelf tijdens deze scan? Form Input -->
<div class="form-group">
    {!! Form::label('instantie_id', 'Welk instantie vertegenwoordig jij zelf tijdens deze scan?:') !!}
    {!! Form::select('instantie_id', $instanties, null, ['class' => 'form-control']) !!}
</div>

<!-- Hidden scanmodel_id Type Form Input -->
{!! Form::hidden('scanmodel_id', 1, null) !!}

<!-- Hidden user_id Type Form Input -->
{!! Form::hidden('user_id', Auth::user()->id, null) !!}

    

<!-- Add Submit Field -->
<div class="form-group">
    {!! Form::submit($submittext, ['class' => 'btn btn-primary form-control']) !!}
</div>