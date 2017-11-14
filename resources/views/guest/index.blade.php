@extends('layout.app')
@section('title', 'Welcome to Share-A-Talk!')
@section('description', env('APP_DESCRIPTION'))

@section('content')
<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <h1 class="text-center">
            Welcome to Share-A-Talk!
        </h1>

        <h3 class="text-center">
            <i>A social network for sharing your favourite talks with the world</i>
        </h3>

        <hr>
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route('auth.register.create') }}" class="btn btn-primary btn-block col-sm-6">Register an account</a>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('auth.login.create') }}" class="btn btn-info btn-block col-sm-6">Log into an existing account</a>
            </div>
        </div>
    </div>
</div>
@endsection
