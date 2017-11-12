@extends('layout.app')
@section('title', 'Log Into an Existing Account')
@section('description', 'Log in with your details and start sharing your favourite talks!')

@section('content')
<h1>Log into an existing account</h1>
<form action="{{ route('auth.login.store') }}" method="POST">
    {{ csrf_field() }}

    <div>
        <label for="email">E-Mail Address</label>
        <div>
            <input type="email" id="email" name="email" placeholder="E-Mail Address" autocomplete="email">
        </div>
    </div>

    <div>
        <label for="password">Password</label>
        <div>
            <input type="password" id="password" name="password" placeholder="Password">
        </div>
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
@endsection
