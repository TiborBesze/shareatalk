@extends('layout.app')
@section('title', 'Register an Account')
@section('description', 'Register an account to Share-A-Talk, and start sharing your favourite talks now!')

@section('content')
<h1>Register an account</h1>

<form action="{{ route('auth.register.create') }}" method="POST">
    {{ csrf_field() }}

    <div>
        <label for="firstname">First Name</label>
        <div>
            <input type="text" id="firstname" name="firstname" placeholder="First Name" autocomplete="firstname">
        </div>
    </div>

    <div>
        <label for="lastname">Last Name</label>
        <div>
            <input type="text" id="lastname" name="lastname" placeholder="Last Name" autocomplete="lastname">
        </div>
    </div>

    <div>
        <label for="email">E-Mail Address</label>
        <div>
            <input type="text" id="email" name="email" placeholder="E-Mail Address" autocomplete="email">
        </div>
    </div>

    <div>
        <label for="password">Password</label>
        <div>
            <input type="password" id="password" name="password" placeholder="Password" autocomplete="off">
        </div>
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <div>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" autocomplete="off">
        </div>
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>
@endsection
