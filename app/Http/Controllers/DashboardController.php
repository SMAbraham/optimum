<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //bringing in the user model

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetching the post for a specific user
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        //dd($user->posts);
        //finding the user model by the user id
        // pass along to the dashboard and because of the relationship I added I can just say $user->post
        return view('dashboard')->with('posts', $user->posts);
    }
}
