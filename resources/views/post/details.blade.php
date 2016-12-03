@extends('layouts.app')

@section('style')
.comment{
    padding: 5px;
}
.post_title{
    border-bottom: 1px solid black;
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <b>{{ $post->user->nickname }}</b> <small>posted at {{ date_format($post->created_at,"H:i | d.m.Y.") }}</small>
                    @if($post->created_at != $post->updated_at)
                    <small>(updated at {{ date_format($post->updated_at,"H:i | d.m.Y.") }})</small>
                    @endif
                </div>

                <div class="panel-body">
                    <div  class="post_title">{{ $post->title }}</div>
                    {{ $post->content }}
                </div>
                @if(Auth::user() && Auth::user()->id == $post->user->id)
                <div class="panel-footer">
                    <a class="btn btn-default btn-sm" href="{{ url('/post/' . $post->id . '/edit') }}">Edit</a>
                    <form action="{{ url('/post/' . $post->id) }}" method="POST" style="display:inline">
                        <input name="_method" type="hidden" value="DELETE"/>
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </div>
                @endif
            </div>

            @foreach($comments as $comment)
            <div class="panel panel-default comment">
                <div>
                    <b>{{ $comment->user->nickname }}</b> <small>commented at {{ date_format($comment->created_at,"H:i | d.m.Y.") }}</small>
                    <small>@if($comment->created_at != $comment->updated_at)</small>
                    (updated at {{ date_format($comment->updated_at,"H:i | d.m.Y.") }})
                    @endif
                </div>

                <div class="panel-body">
                    {{ $comment->content }}
                </div>
                @if(Auth::user() && Auth::user()->id == $comment->user->id)
                <div>
                    <a id="comment_edit" class="btn btn-warning btn-xs">Edit</a>
                    <form action="{{ url('/comment/' . $comment->id) }}" method="POST" style="display:inline">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE"/>
                        <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                    </form>
                </div>
                @endif
            </div>
            @endforeach
            <div>
                <form id="comment_form" style="display:none" method="POST" action="{{ url('/comment') }}">
                    {{ csrf_field() }}
                    <textarea class="form-control" id="comment_content" name="content"  required></textarea>
                    <input name="post_id" type="hidden" value="{{ $post->id }}"/>
                    <button id="comment_submit" class="btn btn-primary btn-sm" type="submit">Confirm</button>
                </form>
            @if(Auth::user())
                <a id="comment_toggle" class="btn btn-primary btn-sm">Comment</a>
            @else
                <a href="{{ url('/login') }}" class="btn btn-primary btn-sm">Comment</a>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script');
<script>
$('#comment_toggle').click(function(){
    $('#comment_form').slideToggle('fast', function(){
        $('#comment_content').focus();
    });
    $(this).toggleClass('btn-primary').toggleClass('btn-danger');
    $(this).text($(this).text() == 'Comment' ? 'Cancel' : 'Comment');
    $('#comment_content').val('');
});
</script>
@endsection
