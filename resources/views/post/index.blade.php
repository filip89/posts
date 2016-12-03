@extends('layouts.app')

@section('style')
.new_post {
    margin: 10px;
}
@endsection('style')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div><a class="btn btn-primary new_post" href="{{ url('/post/create') }}">New post</a></div>
            @foreach($posts as $post)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>{{ $post->user->nickname }}:</b> {{ $post->title }}
                </div>

                <div class="panel-body">
                    {{ $post->content }}
                </div>
                <div class="panel-footer">
                    <a class="btn btn-default btn-sm" href="{{ url('/post/' . $post->id) }}">View</a>
                </div>
            </div>
            @endforeach
            <div style="display:table;margin:auto;">
            {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

