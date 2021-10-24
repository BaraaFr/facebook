@extends('layouts.main')
@section('title','|Edit')
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
	<div class="col-md-8">
		 {!!Form::model($post,['route'=>['posts.update',$post->id], 'method'=> 'PUT', 'enctype'=>"multipart/form-data"])!!}
		{{form::label('title','Title:')}}
		{{form::text('title',$post->title,array('class'=>'form-control form-control-lg mb-1'))}}

		{{form::label('slug','Slug:')}}
		{{form::text('slug',$post->slug,array('class'=>'form-control mb-1 '))}}

 		{{form::label('category_id','Categories:')}}
		{{form::select('category_id',$categories,null,['class'=>'form-control'])}}	

		<div class='mb-4 mt-4'>
            <label for="tags">Select Tags <small style="color:grey;">(for multiple select use: ctrl+click)</small></label>
	            <select  name="tags[]" class="form-control" multiple="multiple" size="3">
	                @foreach($tags as $tag)
	                    <option {{in_array($tag->id,$post->tags()->pluck('tag_id')->toArray()) ? 'selected' : ''}} value="{{ $tag->id }}">{{ $tag->name }}</option>
	                @endforeach
	            </select>
        </div>
        <div class="input-group mb-3">
		  <label class="input-group-text" for="image">Upload</label>
		  <input type="file" name="image" class="form-control" id="image">
		</div>

		{{form::label('body','Body:')}}
		{{form::textarea('body',$post->body,array('class'=>'form-control mt-3'))}}
	</div>
		<div class="col-md-3 offset-md-1 well h-50">	
			<dl class="row ">
				<dt >Created at:</dt>
				<dd class='font-format'><p>{{ date('j.M.Y g:ia',strtotime($post->created_at)) }}</p></dd>
				<dt>Updated at:</dt>
				<dd class='font-format'><p>{{date('j.M.Y g:ia',strtotime($post->updated_at)) }}</p></dd>
			</dl>
			<hr>
				<div class="row">
					<div class="d-grid gap-2 col-6 mx-auto">
						{!!Html::Linkroute('posts.show','Cancel',array($post->id),array('class'=>'btn btn-danger btn-sm'))!!}
					</div>
					<div class="d-grid gap-2 col-6 mx-auto">
						{!!Form::submit('Save',array('class'=>'btn btn-success btn-sm'))!!}
						
					</div>
				</div>
		</div>
	{!!Form::close()!!}
</div>
@endsection
@section('script')
	{!! Html::script('js/select2.min.js') !!}
@stop