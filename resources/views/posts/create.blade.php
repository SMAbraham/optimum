@extends('layouts.app')

@section('content')
<h1>Create Post</h3>
    {{-- Copied from laravel collectives (opening a form) then edit a little bit--}}
    {!! Form::open(['action' => 'PostsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}} {{--A label for title and the actual text which will be Title--}}
            {{-- text import --}}
            {{-- it's gonna be a create form so we don't want a value that is why we have a blank string where are supposed to have a value  --}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}} {{--A label for title and the actual text which will be Title--}}
            {{-- text import --}}
            {{-- it's gonna be a create form so we don't want a value that is why we have a blank string where are supposed to have a value  --}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection