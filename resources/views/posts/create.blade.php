@extends('layouts.main')
@section('title','|create')
@section('stylesheet')
{{Html::style('css/select2.min.css')}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: 'textarea',
        menubar:false
      });
    </script>
@stop
@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2">
		<h1>Create New Post</h1>
		<hr>
		
		{!! Form::open(['route' => 'posts.store','method'=>'POST','enctype'=>"multipart/form-data"]) !!}

			<input type="hidden" name="user_id" value='{{Auth::user()->id}}'>

			{{form::label("title","Title:")}}
			{{form::text("title",null,array('class'=>'form-control'))}}

			{{form::label("slug","Slug:")}}
			{{form::text("slug",null,array('class'=>'form-control mb-2'))}}
			
		<div class="input-group mb-3">
			<label class="input-group-text" for="inputGroupSelect01" value="category_id" name='category_id'>Categories</label>
			  <select class=" form-select form-select-sm "  id="inputGroupSelect01" name="category_id" aria-label=".form-select-sm example">
			    <option selected disabled>Choose Category</option>
					@foreach($categories as $category)
						<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
			  </select>
		</div>
		<div>
            <label for="tags">Select Tags <small style="color:grey;">(for multiple select use: ctrl+click)</small></label>
	            <select  name="tags[]" class="form-control mb-4" multiple="multiple" size="3">
	                @foreach($tags as $tag)
	                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
	                @endforeach
	            </select>
        </div>
        <div class="input-group mb-3">
		  <label class="input-group-text" for="image">Upload</label>
		  <input type="file" name="image" class="form-control" id="image">
		  @error('image')
		  <span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
			</span>
		  @enderror
		</div>

			<label for='body'>Content:</label>
			<textarea name="body" class="form-control">{{-- {!! !!} --}}</textarea>

					
		<div class=" d-grid gap-2 d-md-flex justify-content-md-end">
			{{form::submit("Create",array('class'=>'btn  btn-md mt-1 btn-outline-primary'))}}
    	</div>

		{!! Form::close() !!}

	</div>
</div>


@stop
