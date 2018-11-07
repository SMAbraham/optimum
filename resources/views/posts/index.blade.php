@extends('layouts.app')

@section('content')
<h1>Posts</h3>
    {{-- looping through the posts in our db --}}
    @if(count($posts) > 0)
    @foreach ($posts as $post)
        <div class="card">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                </div>
                <div class="col-md-8 col-sm-8">
                    {{-- to get the posts to take us to a blank page we are gonna add a link --}}
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                </div>
            </div>            
        </div>
        <br/>
    @endforeach
    {{-- creating pagination links --}}
    {{$posts->links()}}
    @else
    <p>No posts found</p>
    @endif 
@endsection