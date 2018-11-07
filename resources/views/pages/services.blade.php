@extends('layouts.app')
@section('content')
        <h1>{{$title}}</h1>
        {{-- we are checking to ensure that there is at least one service in that array(i.e. services array) --}}
        @if(count($services) > 0)
        {{-- if there is, we gonna loop through it --}}
        {{-- applying a bootstrap class --}}
        <ul class="list-group">
                @foreach($services as $service)
                {{-- applying a bootstrap class --}}
                <li class="list-group-item">{{$service}}</li>
                @endforeach
        </ul>
        @endif
@endsection
