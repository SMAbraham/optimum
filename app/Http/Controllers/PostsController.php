<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//we r gonna bring in the model. It has the namespace of app and title of post as seen in Post.php
use App\Post;
//if you don't wanna use eloquent and you wanna use sql. You can bring in the db like so:
//use DB;

class PostsController extends Controller

//in order to add functionality to our post we need to have a bunch of functions in our controller
//we also need a bunch of routes
//we are gonna need a lot of functions here. We are gonna need:
//1. An index - It will be the listing of all posts
//2. A create function - It's gonna represent the form
//3. A store function - The create function will submit to this function. This will take care of submiting data into the module or into the databases
//4. Edit - It will be for the edit form just like create is for the create form
//5. Update - It will take care of actually updating it
//6. Show - It will take care of showing a single post
//7. Destroy - It will take care of deleting it

//adding the middleware for user authetication of posts
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'show']]); // adding exceptions to be able to view blog posts
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //It doesn't need a parameter
    public function index()
    {   
        //we can use any of the model functions and this actually using eloquent, the object relational mapper which makes it easier to do database queries rather write out SQL   
        //return Post::all(); //part of eloquent that is gonna fetch all the records in this model. Its gonna return this and stop its not gonna load the view
        //we wanna load the view in folder called posts in the views folder and a file called index.blade.php
        // $posts = Post::all(); If we wanna select it by title instead of using all we can use order by as follows               
        // return $posts = Post::where('title','Post Two')->get(); if you wanna get in individual post then you shld do it this way(without the return)
        //$posts=DB::select('SELECT * FROM posts'); when using with sql
        //$posts = Post::orderBy('title','desc')->take(1)->get(); if you wanna select 1
        //$posts = Post::orderBy('title','desc')->get(); if you add clauses like this then you say get() at the end otherwise you are not gonna get it
        $posts = Post::orderBy(/*'title'*/'created_at','desc')->paginate(10);//once we hit 11 the pagination will be there       
        return view('posts.index')->with('posts', $posts);//passing the var to our view with 'with'                                                                                                                                                                                                                                                                                                                                                                                                                         
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // It also doesnt need a parameter 
    public function create()
    {
        //loading up a view
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //since we are going to submit to this from form and we need to grab the variables from the form, its gonna take in a request object
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required', //we want the title to be required
            'body' => 'required', //we also want the body to be required
            'cover_image' => 'image|nullable|max:1999' //adding validation for the image
        ]);
        // return 123;

        //handle file upload
        if($request->hasFile('cover_image')){
            //Getting filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);//pathinfo is php and has nothing to do with laravel
            //Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension; //This will make the filename completely unique so that if someone uploads one with the same name it's not gonna ovewrite the other
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        //create post
        $post = new Post; //The reason this can be used is because it has been brought in up there in 'use App\Post;'
        $post->title = $request->input('title'); //will get whatever is submitted for the form
        $post->body = $request->input('body'); //will get whatever is submitted for the form
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        //redirect and set a success msg
        return redirect('/posts')->with('success','Post Created'); //we created the msgs file and this is where we can actually set the msg
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //Its gonna take in an ID because we wanna know which ID of which post we wanna show
    public function show($id)
    {
        //to fetch data from the db with the id from the url
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //this is gonna take an id for the same reason as show(). Because the edit form needs to know which post to show in the form
    public function edit($id)
    {
        //
        $post = Post::find($id);

        //validating the user
        //when in the controller, we can access the user's id with auth
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorised action !');            
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //It will take request and id because we are submitting the post to it and we need to know which one to update
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required', 
            'body' => 'required' 
        ]);
        
         //handle file upload
         if($request->hasFile('cover_image')){
            //Getting filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);//pathinfo is php and has nothing to do with laravel
            //Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension; //This will make the filename completely unique so that if someone uploads one with the same name it's not gonna ovewrite the other
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }        
        
        //create post
        $post = Post::find($id); 
        $post->title = $request->input('title'); 
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }         
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //it has an id so we know whichone to update, or rather destroy
    public function destroy($id)
    {
        $post = Post::find($id);

        //validating the user
        //when in the controller, we can access the user's id with auth
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorised action !');            
        }
        
        if($post->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Post deleted');
    }
}