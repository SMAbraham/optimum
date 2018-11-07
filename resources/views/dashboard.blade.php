@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create"><button class="btn btn-secondary">Create Post</button></a>
                    <br/><br/>
                    <h3>Your Blog Posts</h3>
                    {{-- You are logged in! --}}
                    
                    @if(count($posts) > 0)
                    {{-- creating a table --}}
                    <table class="table table-light">
                        <thead class="thead-dark">
                            <tr>
                                <th><hr/></th>
                                <th><hr/></th>
                                <th><hr/></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit"><button class="btn btn-sm btn-success">Edit</button></a></td>
                                    <td>
                                        {!!Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete !', ['class' => 'btn btn-sm btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>                                
                            @endforeach                            
                        </tbody>
                    </table>
                    @endif                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
