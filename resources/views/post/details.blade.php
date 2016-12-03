@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>{{ $post->user->nickname }}:</b> {{ $post->title }}
                </div>

                <div class="panel-body">
                    {{ $post->content }}
                </div>
                <div class="panel-footer">
                    <a class="btn btn-primary btn-sm">Comment</a>
                    @if(Auth::user() && Auth::user()->id == $post->user()->id)
                    <a class="btn btn-default btn-sm" href="{{ url('/post/' . $post->id . '/edit') }}">Edit</a>
                    <form action="{{ url('/post/' . $post->id) }}" method="POST" style="display:inline">
                        <input name="_method" type="hidden" value="DELETE"/>
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

