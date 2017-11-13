@extends('layout.app')
@section('title', 'Welcome to Share-A-Talk!')
@section('description', env('APP_DESCRIPTION'))

@section('content')
    <div>
        <a href="{{ route('auth.register.create') }}">Register an account</a>
    </div>
    <div>
        <a href="{{ route('auth.login.create') }}">Log into an existing account</a>
    </div>
@endsection
