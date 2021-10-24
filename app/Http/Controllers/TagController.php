<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use Session;

class TagController extends Controller
{       
    public function __construct()
    {
        $this->middleware('auth')->except('tagpage');
    }


    public function index()
    {
        $tags=Tag::all();
        return view('tags.index',compact('tags'));
    }


    public function store(Request $request)
    {
        //validating
       $this->validate($request,array('name'=>'required|max:255'));

       //saving data
       $tag= new Tag;
       $tag->name=$request->name;
       $tag->save();

       //success message
       Session::flash('Success','New tag has been saved successfully!');

       //redirect
       return redirect()->route('tags.index');
    }


    public function show($id)
    {
        $tag=Tag::find($id);
        return view('tags.show',compact('tag'));
    }


    public function edit($id)
    {
        $tag = Tag::findorfail($id);
        return view('tags.edit',compact('tag'));
    }


    public function update(Request $request, $id)
    {
        $tag=Tag::findorfail($id);

        $this->validate($request,['name'=>'required']);
        $tag->name=$request->name;
        $tag->save();

        Session::flash('Success','the tag have been updated!');

        return redirect()->route('tags.index');
    }


    public function destroy($id)
    {
        $tag=Tag::findorfail($id);
        $tag->posts()->detach();
        $tag->delete();

        Session::flash('Delete','Tag has been removed!');

        return redirect()->route('tags.index');
    }

    public function tagpage($id)
    {
        $tag = Tag::find($id);
        return view('tags.one',compact('tag'));
    }
}
