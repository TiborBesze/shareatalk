@extends('layout.app')
@section('title', 'Log Into an Existing Account')
@section('description', 'Log in with your details and start sharing your favourite talks!')

@section('content')
<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <h1>Log into an existing account</h1>

        <form action="{{ route('auth.login.store') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>
                <div>
                    <input type="email" id="email" class="form-control" name="email" placeholder="E-Mail Address" autocomplete="email" autofocus>
                </div>

                @if ($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Password</label>
                <div>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                </div>

                @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection
