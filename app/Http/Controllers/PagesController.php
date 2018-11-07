<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //the index template
    public function index(){
        //create a variable called title in the index function
        $title = 'Welcome To OPTIMUM !';
        //we then wanna bring the title var into our template or our view
        //so we gonna add an extra parameter

        // return view('pages.index', compact('title'));

        //after this go to the index template and insert the title

        //another way of doing it is like this:
        //if u wanna pass in multiple values as an array, you probably wanna use this as well:
        return view('pages.index')->with('title',$title);
    }

    //link the about template
    public function about(){
        $title = 'About us';
        return view('pages.about')->with('title',$title);
    }

    //link the services template
    public function services(){
        //here we will pass in multiple values do demonstrate the advantage of the method we have chosen:

        //data is an associative array(meaning that it has key,value pairs)
        
        $data = array(            
            'title' => 'Services',
            //we are basically passing an array of services here:
            'services' => ['Web Design', 'Web Hosting', 'Programming', 'SEO']
            //since we have put them in the data array, we should be able to access them.
            //go to the services template for accessing
        );
        return view('pages.services')->with($data);
        //go to services view and declare title
    }
}
