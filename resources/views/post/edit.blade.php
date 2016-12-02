@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New post</div>
                <div class="panel-body">
                    <form action="{{ url('/post/' . $post->id) }}" method="POST">
                        <input name="_method" type="hidden" value="PUT"/>
                        {{ csrf_field() }}
                        Title: <input max-length="100" placeholder="Title of maximum 100 signs." name="title" value="{{ $post->title }}" required></input><br/>
                        Content: <textarea max-length="10000" placeholder="Post of maximum 10000 signs." name="content" required>{{ $post->content }}</textarea>
                        <button class="btn btn-primary btn-sm" type="submit">Post</button>
                        <a class="btn btn-danger btn-sm" href="{{ url('/post/' . $post->id) }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
