@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ url('/post/' . $post->id) }}"><-Back to post</a>
            <div class="panel panel-warning">
                <div class="panel-heading">Edit post</div>
                <div class="panel-body">
                    <form action="{{ url('/post/' . $post->id) }}" method="POST">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT"/>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title: </label>
                            <div>
                                <input max-length="100" class="form-control" placeholder="Title of maximum 100 signs." name="title" value="{{ old('title', $post->title) }}" required></input>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="control-label">Content: </label>
                            <div>
                                <textarea max-length="10000" class="form-control" placeholder="Post of maximum 10000 signs." name="content" required>{{ old('content', $post->content) }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm" type="submit">Post</button>
                        <a class="btn btn-danger btn-sm" href="{{ url('/post/' . $post->id) }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
