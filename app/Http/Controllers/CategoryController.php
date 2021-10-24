<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
class CategoryController extends Controller
{


    public function __construct(){
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required','max:255','unique:categories,name'
        ]);

        $category= new Category;
        $category->name = $request->name ;
        $category->save();

        Session::flash('Success','Category created successfully!');

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category = Category::findorfail($id);
        return view("categories.show",compact('category')) ;       
    }

    public function edit($id){
        $category=Category::find($id);
        return view('categories.edit',compact('category'));
    }

   public function update(Request $request,$id)
   {
    $category=Category::findorfail($id);

    $this->validate($request,['name'=>'required|unique:categories,name|max:255']);
    $category->name=$request->name;
    $category->save();

    return redirect()->route('categories.show',$category->id);


   }
}
