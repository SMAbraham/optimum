@extends('layouts.app')

@section('content')
<h1>Edit Post</h3>
    {{-- we have made the action an array so that we can include the id --}}
    {!! Form::open(['action' => ['PostsController@update', $post->id],'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} {{--This is supposed to be a PUT request but laravel doesn't allow us to change from POST to PUT it however allows us to spoof a PUT request--}}
        <div class="form-group">
            {{Form::label('title', 'Title')}} 
            
            {{Form::text('title', $post->title/*Adding the value instead of it being blank as before*/, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}} 
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text'])}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
        </div>
        {{-- We are spoofing a PUT request by adding a hidden input --}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection