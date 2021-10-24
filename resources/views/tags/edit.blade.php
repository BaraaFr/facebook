@extends('layouts.main')
@section('title',"| Tag")
@section('content')

<div class="row">
	<div class="col-md-12">
	{{Form::model($tag, array('route' => array('tags.update', $tag->id),'method'=>'PUT'))}}
		<label name="name">	<h4>Title</h4></label>	
		<input type="text" name="name" class='form-control w-50' value="{{$tag->name}}">
		<button  class="btn btn-primary mt-2 " type="submit">Update</button>
	{{Form::close()}}
	</div>	
</div>

@stop