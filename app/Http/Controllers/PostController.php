<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use App\User;

use Auth;

class PostController extends Controller
{
    //
    
    public function index()
    {    
        
        $posts = Post::all();
        return view('post/index', ['posts' => $posts]); 
        
    }
    
    public function create()
    {
        return view('post/create');
    }
    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required|max:100',
            'content' => 'required|max:10000',
	]);
        
        $user = Auth::user();
        $post = new Post($request->all()); 
        $post->user()->associate($user);
        $post->save();
        
        return redirect('/post');
        
    }
    
    public function details($id)
    {
        
        $post = Post::find($id);
        return view('post/details', ['post' => $post]);
        
    }
    
    public function edit($id)
    {
        
        $post = Post::find($id);
        return view('post/edit', ['post' => $post]);
        
    }
    
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'title' => 'required|max:100',
            'content' => 'required|max:10000',
	]);
        
        $post = Post::find($id);
        //$post->title = $request->title;
        //$post->content = $request->content;
        $post->fill($request->all());
        $post->save();
        
        return redirect('/post/' . $id);
        
    }
    
    public function delete($id)
    {
        
        Post::destroy($id);
        
        return redirect('/post');
        
    }
    
}
