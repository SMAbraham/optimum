<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            //you can add more fields
            //e.g. a title
            $table->string('title');//Since we have a string here we are gonna have an error saying maximum length, not sure why but to fix that we are gonna go to providers then AppServicerovider.php
            //a body
            //will be longer than a string that's why we are using mediumText
            $table->mediumText('body');                       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //Its gonna happen if we roll back the migration
    {
        //if we roll it back we are gonna want to drop the entire posting
        //We are gonna leave this for now but later on we are gonnna add a userID to the post when we impliment authetication
        Schema::dropIfExists('posts'); 
    }
}