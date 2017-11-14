@extends('layout.app')
@section('title', 'Register an Account')
@section('description', 'Register an account to Share-A-Talk, and start sharing your favourite talks now!')

@section('content')
<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <h1>Register an account</h1>

        <form action="{{ route('auth.register.create') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <label for="firstname" class="control-label">First Name</label>
                <div>
                    <input type="text" id="firstname" class="form-control" name="firstname" placeholder="First Name" autocomplete="firstname" value="{{ old('firstname') }}" autofocus required>
                </div>

                @if ($errors->has('firstname'))
                    <span class="help-block">
                        {{ $errors->first('firstname') }}
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="lastname" class="control-label">Last Name</label>
                <div>
                    <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Last Name" autocomplete="lastname" value="{{ old('lastname') }}" required>
                </div>

                @if ($errors->has('lastname'))
                    <span class="help-block">
                        {{ $errors->first('lastname') }}
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>
                <div>
                    <input type="email" id="email" class="form-control" name="email" placeholder="E-Mail Address" autocomplete="email" value="{{ old('email') }}" required>
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
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
                </div>

                @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password_confirmation" class="control-label">Confirm Password</label>
                <div>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="off" required>
                </div>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
