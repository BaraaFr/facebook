@extends('layouts/main')
@section('title',"|Home")

@section('content')
	<style>
		.jumbotron{
			background-color: #F0F8FF;
			padding: 1rem !important;
		}
	</style>
		<div class='row'>
			<div class='col-md-12'>
				@guest
				<div class="jumbotron">
					<h1>Welcome To My Blog</h1>
						<p class="lead">This is my first blog by laravel and bootstrap.Join our community to get the ability of using a lot of our features,such as creating, updating, deleting post and a lot of our new features.Start your journy!! what are you waiting for ;)</p>
						<div class='col-md-2 offset-md-10'>
						<p><a class="btn btn-outline-success btn-bg" href="{{route('login')}}" role="button">Login</a>
							<a class="btn btn-outline-primary btn-primary-bg" href="{{route('register')}}" role="button">Register</a>
						</p>
						</div>
				</div>
				@endguest
				@auth
				<div class="jumbotron">
					<h1>Welcome To My Blog</h1>
					<p class="lead">This is my first blog by laravel and bootstrap.Enjoy your experience with no limits ;)!</p>
				</div>
				@endauth
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				@foreach($posts as $post)
				<div class="post">
				<h3>{{$post->title}}</h3>            
				<p>{{substr(strip_tags($post->body),0,200)}}{{strlen(strip_tags($post->body))>200?'...':''}}</p>
					<div class="row">
						<div class="col-sm-2 offset-sm-10">
							<a class="btn btn-primary mt-3" href={{url('blog',$post->slug)}}>Read more</a>
						</div>
					</div>
				</div>
<hr>
				@endforeach
			</div>
			<div class='col-md-3 offset-md-1'>
				<div style="margin-top:2rem !important;">
				<h2>Categories</h2>
				<div class="offset-md-1">
					<div class="btn-group btn-group-vertical" role="group"style="margin-top:3rem !important;" aria-label="Button group with nested dropdown">
						@foreach($categories as $category )
							@if($category->posts()->where('category_id',$category->id)->count()>0)
							  	<a href="{{route("categories.show",$category->id)}}" class="btn btn-outline-primary m-1">{{$category->name}}</a>
							@endif
						@endforeach
					</div>
				</div>
				</div>
			</div>   
		</div>
 		<div class="row">
		<div class='col-md-1 offset-md-11'>
		{!! $posts->links(); !!}
		</div>
	</div>


@endsection
