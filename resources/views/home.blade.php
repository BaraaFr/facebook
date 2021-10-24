@extends('layouts.app')
@section('dropdown')
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-spacing">
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ Auth::user()->name }}</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('posts.index')}}">Posts</a></li>
                  <li><a class="dropdown-item" href="{{route('categories.index')}}">Categories</a></li>
                  <li><a class="dropdown-item" href="{{route('tags.index')}}">Tags</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>           
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
