
<div class='row'>
	<div class="col-md-11">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link {{Request::is('/')?'active':''}}" aria-current="page" href="/">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{Request::is('blog')?'active':''}}" aria-current="page" href="/blog">Blog</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{Request::is('about') ? 'active' :''}} " href="/about">About</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link {{Request::is('contact')?'active':''}}" href="/contact">Contact</a>
			</li>
		</ul>
	</div>

	<div class="col-md-1">
		
		<ul class="nav nav-tabs nav-spacing">
		  	<li class="nav-item dropdown">
		  	@if(Auth::check())  
		    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{Auth::user()->name}}</a>
			 <ul class="dropdown-menu">
			      <li><a class="dropdown-item {{Request::is('posts') ? 'active' :''}} " href="{{route('posts.index')}}">Posts</a></li></i>
			      <li><a class="dropdown-item {{Request::is('categories') ? 'active' :''}}" href="{{route('categories.index')}}">Categories</a></li>
			      <li><a class="dropdown-item {{Request::is('tags') ? 'active' :''}}" href="{{route('tags.index')}}">Tags</a></li>
			      <li><hr class="dropdown-divider"></li>
			      <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
			    </ul>
			@else
					{{-- <a href="{{route('login')}}" class="btn btn-outline-primary" style="width:100px; margin:1.5px;">Login</a> --}}
					<a class="nav-link" style="color:green;"  href="{{route('login')}}" role="button" aria-expanded="false">Login</a>
		    </li>
		</ul>
		
		@endif		
	</div>
</div>