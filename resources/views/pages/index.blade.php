{{-- extend the layout from app.blade --}}
@extends('layouts.app')

{{-- for the details below(the <h1> and <p> elements) to go into the main content we have to wrap it(in @section & @endsection)--}}
{{-- you'll have to do this for the other pages; about & services --}}
@section('content')
<br/><br/>
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>Your number one blogginng site</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>  <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
@endsection
   