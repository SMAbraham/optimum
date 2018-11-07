<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//you don't have to do much here because everything is in "Model"-mean like the model in class Post extends 'Model'
class Post extends Model
//we are gonna add a relationship btwn posts and users later on so we don't have to do that here
{
    //we can set some values here like; 'Table Name'
    //by default to the tables,if we create a model called post the table name is gonna be posts(plural)
    //if you wanted to change that you could by specifying:
        //Table Name
        protected $table = 'posts'; //we don't have to put this here but we are doing it for reference
        //you can also change the primary key field
        //Primary Key
        public $primaryKey = 'id';//we are using id cause that's the default and that's what we have in our database but you can change.You just have to specify
        //you can also specify if you want time stamps for your records
        //we don't have to have this cause it's true by default(we have the 'created at'&'updated at' fields: If din't want them the we could put false)
        public $timestamps = true;

        //creating a relationship
        //i.e; a post has a relationship with a user and it belongs to a user
        public function user(){
            return $this->belongsTo('App\User'); //the model of the user "App\User"
        }
}

//the 'Post' moddel. It gets all models.
// it is coming from the extended model above
// Post::all();
//so we have a tone of functionality available to us through the model 
