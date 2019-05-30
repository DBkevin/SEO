<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function index(){
        $posts=Post::paginate(10);
      
        return view('post.index',['posts'=>$posts]);
    }
    public function show($id){
        
        $post=Post::where('id','=',$id)->first();
        return view('post.show',compact('post'));
    }
}
