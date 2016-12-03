@extends('layouts.app')

@section('style')
.own_post {
    background-color: #e6f3ff;
}
@endsection('style')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div><a class="btn btn-primary new_post" href="{{ url('/post/create') }}">Create new post</a></div>
            <div class="table-responsive">
                <table class="table">
                <thead>
                    <tr>  
                        <th>Title</th>
                        <th>User</th>
                        <th>Comments</th>
                        <th>Date created</th>
                    </tr>
                </thead>
            
                <tbody>
                @foreach($posts as $post)
                    <tr class="{{Auth::user() ? (Auth::user()->id == $post->user->id ? 'own_post' : '') : ''}}">
                        <td>
                            <a href="{{ url('/post/' . $post->id) }}">{{ $post->title }}</a>
                        </td>
                        <td>
                            @if(Auth::user() && Auth::user()->id == $post->user->id)
                            <i class="fa fa-user"></i>
                            @endif
                            {{ $post->user->nickname }}
                        </td>
                        <td>
                            {{ count($post->comments) }}
                        </td>
                        <td>
                            {{ date_format($post->created_at,"H:i:s | d.m.Y.") }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>
            <div style="display:table;margin:auto;">
            {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

