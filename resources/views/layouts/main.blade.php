
<!DOCTYPE html>
<html lang="en">
	<head>
	@include("partials.head")
		<style>
			.row{
				margin:1rem !important;
			}
		</style>
		

	</head>	
	<body>

		@include('partials.nav')
		
		<div class="container">
			@include('partials.message')
			@yield('content')
			@include('partials.footer')
		</div>
		
	</body>
</html>