<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Post;

class CommentController extends Controller
{

    public function store(Request $request,$post_id)
    {
        $this->validate($request,[
            'name'=>'required|max:100',
            'email'=>'required|email',
            'comment'=>'required|min:5',
            'user_id'=>'required|integer'
        ]);
        
        $post = Post::findorfail($post_id);

        $comment= new Comment();
        
        $comment->name       =   $request->name;
        $comment->email      =   $request->email;
        $comment->comment    =   $request->comment;
        $comment->user_id    =   $request->user_id;
        $comment->approved   =  true;

        $comment->post()->associate($post);
        
        $comment->save();

       return redirect()->route('blog.single',[$post->slug]);
    }

    public function destroy($id)
    {
         $comment=Comment::find($id);
         $comment->delete();

         return redirect()->back();
    }
}
