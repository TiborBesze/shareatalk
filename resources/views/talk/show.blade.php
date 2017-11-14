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
    </div>
</div>
@endsection
