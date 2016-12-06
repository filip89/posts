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
    
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'details');
    }
    
    
    public function index(Request $request)
    {    
        
        if(Auth::user() && $request->userOnly == 'on'){
            
            $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->paginate(10);
            $filter = 'on';
            
        }
        else{
            
            $posts = Post::orderBy('created_at', 'desc')->paginate(10);
            $filter = false;
            
        }

        return view('post/index', ['posts' => $posts, 'filter' => $filter]); 
        
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
        
        $post = Post::findOrFail($id);
        
        $comments = $post->comments;
        
        return view('post/details', ['post' => $post, 'comments' => $comments]);
        
    }
    
    public function edit($id)
    {
        
        $post = Post::findOrFail($id);
        
        return view('post/edit', ['post' => $post]);
        
    }
    
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'title' => 'required|max:100',
            'content' => 'required|max:10000',
	]);
        
        $post = Post::findOrFail($id);
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
