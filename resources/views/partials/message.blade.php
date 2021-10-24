
@if(Session::has('Success'))
	<div class="alert alert-success" role="alert">
		Success: {{ Session::get('Success') }}
	</div>
@endif
@if(Session::has('Delete'))
	<div class="alert alert-danger" role="alert">
		Success: {{ Session::get('Delete') }}
	</div>
@endif

@if(count($errors) > 0)

	<div class="alert alert-danger" role="alert">
		<strong>Error</strong>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
