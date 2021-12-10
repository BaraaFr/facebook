<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Post;
use App\Tag;

class SingelController extends Controller
{
    public function getSingle($slug){
    	$post = Post::where('slug','=',$slug)->first();
       	return view('blog.single',compact('post'));
    }

    public function getIndex(){
    	$posts = Post::paginate(3);

    	return view('blog.index',compact('posts'));
    }
}
