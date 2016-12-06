@extends('layouts.app')

@section('style')
.table {
    width:100%;
}
thead {
    background-color: #595959;
    color: white;
}
th:nth-child(2) {
    width: 50%;
}
th:nth-child(2){
    width: 15%;
}
th:nth-child(3){
    width: 15%;
}
th:nth-child(4){
    width: 20%;
}
a:hover {
    text-decoration: none;
}
#filter {
    float: right;
    padding: 10px;
    background-color: #f2f2f2;
    border-radius: 5px;
}
.table-responsive{
    clear: both;
}
#create_btn {
    float: left;
    margin-bottom: 10px;
}
@endsection('style')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div id="create_btn"><a class="btn btn-default new_post" href="{{ url('/post/create') }}"><i class="fa fa-btn fa-file-text-o"></i>Create new post</a></div>
            @if(Auth::user())
            <div id="filter">
                <form action="{{ url('/post') }}" method="GET">
                    <input type="checkbox" name="userOnly" {{ $filter ? 'checked' : ''}} onchange="this.parentNode.submit()"> <b>My posts only</b></input>
                </form>
            </div>
            @endif
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
                    <tr class="{{Auth::user() ? (Auth::user()->id == $post->user->id ? 'owner' : '') : ''}}">
                        <td>
                            <a href="{{ url('/post/' . $post->id) }}"><b>{{ $post->title }}</b></a>
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
            {{ $posts->appends(['userOnly'=>$filter])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
