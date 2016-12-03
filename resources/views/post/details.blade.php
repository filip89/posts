@extends('layouts.app')

@section('style')
.comment_field
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <b>{{ $post->user->nickname }}:</b> {{ $post->title }} {{ $post->updated_at}}
                </div>

                <div class="panel-body">
                    {{ $post->content }}
                </div>
            </div>
            @foreach($comments as $comment)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>{{ $post->user->nickname }}:</b> {{ $post->title }}
                </div>

                <div class="panel-body">
                    {{ $post->content }}
                </div>
            </div>
            @endforeach
            @if(Auth::user() && Auth::user()->id == $post->user()->id)
            <div>
                <a class="btn btn-default btn-sm" href="{{ url('/post/' . $post->id . '/edit') }}">Edit</a>
                <form action="{{ url('/post/' . $post->id) }}" method="POST" style="display:inline">
                    <input name="_method" type="hidden" value="DELETE"/>
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </div>
            @endif
            <div ng-app='comment' ng-controller='comm-ctrl'>
                <form name="comment_form" ng-submit="submitForm(comment_form)" ng-show='input_show'>
                    <textarea ng-model='comment_content' required></textarea>
                    <input name="post_id" type="hidden" ng-model='post_id' value="{{ $post->id }}"/>
                </form>
                <div>
                    <a ng-show='input_show' ng-click='send()' class="btn btn-primary btn-sm">Confirm</a>
                    <a ng-click='form_toggle()' class="btn @{{ btn_style }} btn-sm">@{{ form_btn }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script');
<script>
    $app = angular.module('comm', []);
    $app.controller('comm-ctrl', function($scope, $http){
        $scope.input_show = false;
        $scope.form_btn = 'Comment';
        $scope.btn_style = 'btn-primary';
        $scope.form_toggle = function(){
            $scope.input_show = !$scope.input_show;
            if($scope.input_show){
                $scope.form_btn = 'Cancel'
                $scope.btn_style = 'btn-danger';
            }
            else{
                $scope.form_btn = 'Comment'
                $scope.btn_style = 'btn-primary';
            }
        }
        
        $scope.send = function(){
            if($scope.comm_content){
                alert 'valid';
            }
            $http({
                method : "POST",
                url : "/comment?post_id=" + $scope.post_id
            });
        }
        
    });
</script>
@endsection
