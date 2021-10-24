<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\like;
use App\Post;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store($postId)
    {
        $post = Post::find($postId);
        $post->like(auth()->id());
        return back();
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->dislike(auth()->id());

        return back();
    }
}
