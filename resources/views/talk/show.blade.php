@extends('layout.app')
@section('title', $talk->title)
@section('description', $talk->description)

@section('content')
    <h1>{{ $talk->title }}</h1>
    <p>{{ $talk->description }}</p>
@endsection
