 <?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	//main pages routes
	Route::get('/','BlogController@blog');
	Route::get('blog/{slug}','SingelController@getsingle')->name('blog.single')->where('slug','[\w\d\-\_]+');
	Route::get('blog','SingelController@getIndex')->name('blog.index');
	Route::get('/about','BlogController@about');
	Route::get('/contact','BlogController@contact');
	Route::get('/poststag/{id}','TagController@tagpage')->name('post.tag');
	Route::post('/contact','BlogController@getcontact');
	Route::get('/home', 'HomeController@index')->name('home');
	
	//post,cat,tag  routes
	Route::resource('posts','PostController');
	Route::resource('categories','CategoryController',['except'=>'create']);
	Route::resource('tags','TagController',['except'=>'create']);

	//comment route
	Route::post('comments/{post_id}','CommentController@store')->name('comments.store');
	Route::delete('comments/{comment}','CommentController@destroy')->name('comments.destroy');

	//like and dislike routes
	Route::post('post/{post_id}/like','LikeController@store')->name('post.like');
	Route::delete('post/{post_id}/like','LikeController@destroy')->name('post.dislike');

	//Auth Routes
	Auth::routes();	
	Route::get('/logout', 'Auth\LoginController@logout');