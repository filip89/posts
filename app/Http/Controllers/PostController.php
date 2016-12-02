<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
    //
    
    public function index()
    {
        return 'post_controller@index';
    }
    
    public function create()
    {
        return 'post_controller@create';
    }
    
    public function store(Request $request, $id)
    {
        
    }
    
    public function details($id)
    {
        return 'post_controller@details';
    }
    
    public function edit($id)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function delete($id)
    {
        
    }
    
}
