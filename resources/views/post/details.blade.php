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
    padding: 5px;
}
.options, .comment_options{
    float: right;
    color: black;
}
.comment_options{
    opacity: 0;
    transition: opacity 0.2s;
}

.post_div .panel-body{
    min-height: 150px;
}
.comment:hover .comment_options {
    opacity: 1;
}

.panel {
    margin-bottom: 5px;
}

.comment_content_input, #edit_comment_content_input {
    max-height: 200px;
    resize: vertical;
}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary post_div">
                <div class="panel-heading">
                    <b><i class="fa fa-btn fa-file-text-o"></i>{{ $post->user->nickname }}</b> <small>posted at {{ date_format($post->created_at,"H:i | d.m.Y.") }}</small>
                    @if($post->created_at != $post->updated_at)
                    <small>(updated at {{ date_format($post->updated_at,"H:i | d.m.Y.") }})</small>
                    @endif
                    @if(Auth::user() && Auth::user()->id == $post->user->id)
                    <div class="dropdown options">
                        <button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-btn fa-cog"></i>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ url('/post/' . $post->id . '/edit') }}">Edit</a></li>
                            <li><a href="#" class="delete_btn" data-toggle="modal" data-type="post" data-target="#delete_modal">Delete</a></li>
                            <form action="{{ url('/post/' . $post->id) }}" method="POST" style="display:inline">
                                <input name="_method" type="hidden" value="DELETE"/>
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </div>
                    @endif
                </div>

                <div class="panel-body">
                    <div  class="post_title">{{ $post->title }}</div>
                    {{ $post->content }}
                </div>
            </div>
        </div>
    </div>
    
    @foreach($comments as $comment)
    <div class="row">   
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default comment">
                <div>
                    <i class="fa fa-btn fa-pencil"></i><b>{{ $comment->user->nickname }}</b>
                    <small>commented at {{ date_format($comment->created_at,"H:i | d.m.Y.") }}</small>
                    @if($comment->created_at != $comment->updated_at)
                    <small>(updated at {{ date_format($comment->updated_at,"H:i | d.m.Y.") }})</small>
                    @endif
                    @if(Auth::user() && Auth::user()->id == $comment->user->id)
                    <div class="dropdown comment_options">
                        <button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-btn fa-cog"></i>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#" data-toggle="modal" onclick="populate_comment_modal(this)" data-edit-link="{{ url('/comment/' . $comment->id) }}" data-target="#edit_comment_modal">Edit</a></li>
                            <li><a href="#" class="delete_btn" data-toggle="modal" data-type="comment" data-target="#delete_modal">Delete</a></li>
                            <form action="{{ url('/comment/' . $comment->id) }}" method="POST">
                                <input name="_method" type="hidden" value="DELETE"/>
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="panel-body">
                    <span class="comment_content">{{ $comment->content }}</span>
                </div>
            </div>     
        </div>
    </div>
    @endforeach
    
    <div class="row">    
        <div class="col-md-8 col-md-offset-2">
            <div>
                @if(Auth::user())
                <form id="comment_form" method="POST" action="{{ url('/comment') }}">
                    {{ csrf_field() }}
                    <textarea class="form-control comment_content_input" name="content" placeholder="Leave a comment here..." maxlength="2000" required></textarea>
                    <input name="post_id" type="hidden" value="{{ $post->id }}"/>
                    <button class="btn btn-primary btn-xs comment_submit" type="submit" style="display:none"></button>
                </form>
                @else
                <textarea class="form-control comment_content_input" name="content" placeholder="You need to be logged in to comment!" disabled></textarea>
                @endif
            </div>
        </div>
    </div>
    
</div>

<!-- Delete modal -->
<div id="delete_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete the <span id="type_in_modal"></span></h4>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit_delete" class="btn btn-danger" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
        
    </div>
</div>

<!-- Delete modal -->
<div id="edit_comment_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit the comment</span></h4>
            </div>
            <div class="modal-body">
                <form id="edit_comment_form" method="POST">
                    <input name="_method" type="hidden" value="PUT"/>
                    {{ csrf_field() }}
                    <textarea class="form-control" id="edit_comment_content_input" name="content" placeholder="Leave a comment here..." maxlength="2000" required></textarea>
                    <button class="btn btn-danger comment_submit" style="display:none"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>       
    </div>
</div>

<!-- Comment error modal -->
<div id="error_modal" class="modal fade {{ $errors->has('content') ? 'triggered' : '' }}" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">There were errors!</h4>
      </div>
      <div class="modal-body" style="color:red">
            <strong>{{ $errors->first('content') }}</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection

@section('script')
<script>
    
var form;

$(document).on('click', '.delete_btn', function(){
    var type = $(this).data('type');
    form = $(this).closest('ul').find('form');
    $('#type_in_modal').text(type);
});

$('.comment_content_input, #edit_comment_content_input').keydown(function(e){
    if(e.which == 13 && !e.shiftKey){
        e.preventDefault();
        $(this).closest('form').find('.comment_submit').trigger('click');
    }
});

$(document).on('click', '#submit_delete', function(){
    $(form).submit();
});

function populate_comment_modal(edit_btn){
    var comment_content = $(edit_btn).closest('.panel').find('.comment_content').text();
    $('#edit_comment_form').attr('action', $(edit_btn).data('edit-link'));
    $('#edit_comment_content_input').val(comment_content);
}

if($('#error_modal').hasClass('triggered')){
    $('#error_modal').modal('show');
}

</script>
@endsection
