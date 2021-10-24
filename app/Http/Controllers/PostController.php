<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //create a vraiable that xontain all posts
        $posts=Post::orderby('id','asc')->paginate(5);
        //return the page to view eith the above variable 
        return view("posts.index")->withPosts($posts);
    }


    public function create()
    {
        $categories=Category::all();
        $tags= Tag::all();
       return view('posts.create',compact('categories','tags'));
    }

    public function store(Request $request)
    {
        //step1: validation of data
        $this->validate($request,array(
            'title'         =>  'required|max:255',
            'body'          =>  'required',
            'category_id'   =>  'required|integer',
            'user_id'       =>  'required|integer',
            'slug'          =>  'required|alpha_dash|min:5|max:255|unique:posts,slug'
        ));
        //step2: storing data in database 
        $post=new Post();

        $post->title        =   $request->title;
        $post->body         =   $request->body;
        $post->slug         =   $request->slug;
        $post->category_id  =   $request->category_id;
        $post->user_id      =   $request->user_id;

        if(isset($request->image)){

            $imageName = $request->file('image');
            $filename= time() . '.' . $imageName->getClientOriginalExtension();
            $location = public_path('images/'. $filename);
            Image::make($imageName)->resize(800,400)->save($location);
            $post->image = $filename;
            
        }
        $post->save();
    //pass id or array of a Trophy ids 
        $post->tags()->attach($request->tags);

        Session::flash('Success','The Post Has Been Saved Successfully!');

        return redirect()->route('posts.show', $post->id);
    }

    public function show($id)
    {   $post= Post::findorfail($id);

       return view('posts.show',compact('post'));
    }

    public function edit($id)
    {   
        $post       = Post::findorfail($id);
        $categories = Category::all();
        $cats       =[];
        foreach($categories as $category){
        //key                =       value
        $cats[$category->id] = $category->name;
            }
        $tags = Tag::all();
        return view('posts.edit',compact('post','tags'))->withCategories($cats);
    }

    public function update(Request $request, $id)

    {   
       $post=Post::findorfail($id);
        //validating the data 
        if($request->input('slug')== $post->slug){
        $this->validate($request,array(
            'title'     =>  'required|max:255',
            'category_id'=>'required|integer',
            'image'     =>'image',
            'body'      =>  'required'));
    
        }else{ $this->validate($request,array(
            'title'     =>  'required|max:255',
            'body'      =>  'required',
            'category_id'=>'required|integer',
            'image'     =>'image',
            'slug'      =>  'required|alpha_dash|min:5|max:255|unique:posts,slug'));
        } 

        //find the post and save the data in database
        $post=Post::findorfail($id);
        
        //request->input('field') same as  $request->field ;
        $post->title       =    $request->input('title');
        $post->body        =    $request->input('body');
        $post->slug        =    $request->input('slug');
        $post->category_id =    $request->input('category_id');
        
        if(isset($request->image)){
            //adding the new photo
            $imageName = $request->file('image');
            $filename= time() . '.' . $imageName->getClientOriginalExtension();
            $location = public_path('images/'. $filename);
            Image::make($imageName)->resize(800,400)->save($location);
            $oldimagefile=$post->image;

            //updating database
            $post->image = $filename;

            //deleting the old image
            Storage::delete($oldimagefile);
        }
        $post->save();
        //sync the data
        $post->tags()->sync($request->tags);
        //set a flash message
        Session::flash('Success','The Post is Updated Successfully!');
        //redirecting
        return redirect()->route("posts.show",$post->id);
    }

    public function destroy($id)
    {
        //find the post
        $post=Post::findorfail($id);
        $post->tags()->detach();
        //delete the post
        $post->delete();


        //eset a flash message
        Session::flash('Delete','The Post Has Been Deleted!');

        //redirect to the main page(page of posts)
        return redirect()->route('posts.index'); 
    }
}
