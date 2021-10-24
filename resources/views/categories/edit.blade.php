@extends('layouts.main')
@section('title',"|Categories")
@section('content')
<div class="row">
	<div class="col-md-12">
	{{Form::model($category, array('route' => array('categories.update', $category->id),'method'=>'PUT'))}}
		<label name="name">	<h4>Title</h4></label>	
		<input type="text" name="name" class='form-control w-50' value="{{$category->name}}">
		<button  class="btn btn-primary mt-2 " type="submit">Update</button>
	{{Form::close()}}
	</div>	
</div>

@stop