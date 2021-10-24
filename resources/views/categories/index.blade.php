@extends('layouts.main')
@section('title','| Categories')
@section('content')

<div class="row">
	<div class='col-md-8'>
		<h1>Categories</h1>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th></th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($categories as $category)
				<tr>
					<th>{{$category->id}}</th>
					<td>{{$category->name}}</td>
					<td>
						<a href="{{route("categories.show",$category->id)}}" class="btn btn-secondary btn-sm">View</a>
					</td>
				</tr>
				@endforeach
			</tbody>
	
		</table>
	</div>

	<div class='col-md-3 offset-md-1' >
		<div class="card text-black border-secondary mb-3 mt-3" style="max-width: 18rem;">
		  <div class="card-header border-secondary">Create New Category</div> 
		  	<div class="card-body ">
		    	Create new category
				<form action="{{route('categories.store')}}" method="POST">
					@csrf
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<input type="text" name="name" class='form-control m-1 w-75 form-control-sm'>				
					<button class="btn btn-outline-secondary m-1 btn-sm" type="submit">Create</button>
				</form>
		  	</div>
		</div>
	</div>
</div>

@stop