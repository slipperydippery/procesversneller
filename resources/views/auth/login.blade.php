@extends('layouts.appcms')

@section('content')
<div class="container container--page">
    <div class="row">
        <div class="col-sm-12 page--head">
            <h2>Log in</h2>
            <h3>Leuk dat je aan de slag gaat, veel succes!</h3>
        </div>
        <div class="col-sm-12">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-2 control-label">emailadres</label>

                    <div class="col-md-10">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-2 control-label">wachtwoord</label>

                    <div class="col-md-10">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Onthoud mij
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn btn--fullwidth">
                            log in
                        </button>
                        <br><br>

                        <a class="btn btn-link btn--secondary btn--fullwidth" href="{{ route('password.request') }}">
                            wachtwoord kwijt? vraag hier een nieuwe aan
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
