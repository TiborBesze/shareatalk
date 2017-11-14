@extends('layout.app')
@section('title', $talk->title)
@section('description', $talk->description)

@section('content')
<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <h1>{{ $talk->title }}</h1>

        <p>{{ $talk->description }}</p>

        @includeWhen($talk->platform === 'youtube', 'talk.partials._youtube')
        @includeWhen($talk->platform === 'vimeo', 'talk.partials._vimeo')
        @includeWhen($talk->platform === 'ted', 'talk.partials._ted')

        <hr>

        <div class="row">
            <div class="col-sm-6">
                Posted by {{ $talk->user->fullname }}
                @includeWhen($followable, 'talk.partials._follow')
            </div>
            <div class="col-sm-6">
                <div class="pull-right">
                    @include('talk.partials._like')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
