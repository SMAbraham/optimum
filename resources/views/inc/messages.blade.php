{{-- Here we wanna check 3 things: --}}
{{-- 1. The errors array that's created when we fail validation --}}
{{-- 2. Session values i.e. session success and session error(they are gonna be flash messages that we can create at any point) --}}

{{-- looking for errors --}}
@if(count($errors)>0)
    @foreach($errors->all() as $error){{--since it is an obj we will use $errors->all()--}}
    <div class="alert alert-danger">
        {{$error}}
    </div>
    @endforeach
@endif

{{-- check for session success --}}
@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

{{-- check for session error --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif