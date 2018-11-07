@extends('layouts.app')

@section('content')
<br/>
<a href="/posts" ><button class="btn btn-sm btn-secondary"><< GO</button></a>
<br/><br/>
{{-- we just need to have access to the post. It isn't an array we don't have to loop through it --}}
<h1>{{$post->title}}</h3>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">    
    <div>
        {!!$post->body!!}
    </div>
    <hr/>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr/>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)        
    <div>
    <a href="/posts/{{$post->id}}/edit"><button class="btn btn-sm btn-success float-left">Edit >></button></a>    
    {!!Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST', 'class' => 'float-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete !', ['class' => 'btn btn-sm btn-danger'])}}
    {!!Form::close()!!}
        @endif
    @endif
    </div>
@endsection