<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;

use App\Post;

use App\User;

use Auth;

class CommentController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function store(Request $request)
    {
        
        $user = Auth::user();
        
        $comment = new Comment($request->all());
        $comment->user()->associate($user);
        $comment->post_id = $request->post_id;
        $comment->save();
        
        return back();
        
    }
    
    public function update(Request $request, $id)
    {
        
        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->save();
        
        return back();
        
    }
    
    public function delete($id)
    {
        
        Comment::destroy($id);
        
        return back();
        
    }
}
