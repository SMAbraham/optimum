<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//we  are adding this to solve the string issue in the create_posts_table.php in the migrations
use Illuminate\Support\Facades\Schema;//we are bringing in the schema library

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //add sth in here after bringing in schema
        Schema::defaultStringLength(191); //if we don't include this here we are gonna get some strange error when we run the migration
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
