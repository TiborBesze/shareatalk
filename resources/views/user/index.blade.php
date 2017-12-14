@extends('layout.app')
@section('title', 'Home')
@section('description', 'Post a talk, or view a talk from your news feed!')

@section('content')
<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <h1>News Feed</h1>

        @foreach ($talks->chunk(2) as $chunk)
        <div class="row">
            @foreach ($chunk as $talk)
            <div class="col-sm-6">
                <a href="{{ route('talk.show', $talk->id) }}">
                    <img class="img-responsive" src="{{ $talk->thumbnail }}" alt="{{ $talk->title }}">
                </a>
                <a href="{{ route('talk.show', $talk->id) }}">
                    {{ $talk->title }}
                </a>
                <div>Posted by: {{ $talk->user->fullname }}</div>
                <div>Posted at: {{ $talk->created_at->format('d/m/Y') }}</div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection
