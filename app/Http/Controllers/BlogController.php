<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Post;
use App\Category;
use Session;
use Mail;

class BlogController extends Controller
{
	public function blog(){

		$categories =	Category::all();
		$posts 		= 	Post::orderBy('id', 'desc')->paginate(3);
		return view('Blog',compact('posts','categories'));
	}
	public function about(){
		return view('about');
	}
	public function contact(){
		return view('contact');
	}
	public function getcontact(Request $request){

		$this->validate($request,[
		'email'=>'required|email',
		'name'=>'required',
		'subject'=>'required|max:255',
		'comments'=>'required'
	]);
		$data = [
		'email'=>$request->email,
		'name'=>$request->name,
		'subject'=>$request->subject,
		'comments'=>$request->comments
	];
	Mail::send('emails.contact',$data,function ($message)use ($data){
		$message->from($data['email'],$data['name']);
		$message->to('baraafr08@gmail.com');
		$message->subject($data['subject']);

	});
	Session::flash('Success','Message has been Sent!');

	return redirect('/');
	} 
}
?>