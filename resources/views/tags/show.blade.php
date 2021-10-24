@extends('layouts.main')
@section('title',"| $tag->name Tag")
@section('content')
<div class='row'>
	<div class="col-md-8">	
		<h1>{{$tag->name}} Tag</h1><small>{{$tag->posts()->count()}} {{$tag->posts()->count()>1 ?'posts':'post' }}</small>
	</div>
	<div class="col-md-2 ">	
		<div class='d-grid gap-2'>	
		<a href="{{route('tags.edit',$tag->id)}}" class="btn btn-outline-primary mt-3 btn-sm">Edit</a>
		</div>
	</div>
	<div class='col-md-2'>
		<form action="{{route('tags.destroy',$tag->id)}}" method="POST">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<div class='d-grid gap-2'>	
				<button class="btn btn-outline-danger mt-3 btn-sm" type="submit">Delete</button>
			</div>
		</form>
	</div>
	<div class="col-md-4 offset-md-8">
		<div class="d-grid gap-2">
		<a href="{{route('post.tag',$tag->id)}}" class="btn btn-outline-success btn-sm"> View All Posts</a>
		</div>
	</div>
</div>
<hr>	
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Post Title</th>
					<th>Tags</th>
					<th></th>
				</tr>	
			</thead>
			<tbody>
				@foreach($tag->posts as $post)
					<tr>
						<th>{{$post->id}}</th>
						<td>{{$post->title}}</td>
						<td>
							@foreach($post->tags as $tag)
								<span class="label">{{$tag->name}}</span>
							@endforeach
						</td>
						<td><a href="{{route('posts.show',$post->id)}}" class="btn btn-outline-secondary btn-sm ">View</a></td>
					</tr>
				@endforeach
			</tbody>	
		</table>	
	</div>	
</div>

@stop