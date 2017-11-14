@extends('layout.app')
@section('title', 'Post a talk')
@section('description', 'Post a talk to share it with the world.')

@section('content')
<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <h1>Post a talk on your timeline</h1>

        <form action="{{ route('talk.store') }}" method="POST" autocomplete="off">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                <label for="url" class="control-label">URL</label>
                <div>
                    <input type="text" id="url" class="form-control" name="url" placeholder="URL">
                </div>

                @if ($errors->has('url'))
                    <span class="help-block">
                        {{ $errors->first('url') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="Submit" class="btn btn-success">Post</button>
            </div>
        </form>
    </div>
</div>
@endsection
