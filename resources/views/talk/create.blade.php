@extends('layout.app')
@section('title', 'Post a talk')
@section('description', 'Post a talk to share it with the world.')

@section('content')
<h1>Post a talk on your timeline</h1>
<form action="{{ route('talk.store') }}" method="POST" autocomplete="off">
    {{ csrf_field() }}

    <div>
        <label for="url">URL</label>
        <div>
            <input type="text" id="url" name="url" placeholder="URL">
        </div>
    </div>

    <div>
        <button type="Submit">Post</button>
    </div>
</form>
@endsection
