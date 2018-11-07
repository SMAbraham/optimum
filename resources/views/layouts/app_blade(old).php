<!-- The code in this file isn't used anywhere in this system. This was the original code for the layouts/app.blade.php 
and it was copied here for referrence purposes. The app.blade.php was altered after running the command to enable
user authetication: (php artisan make:auth). -->

<!-- This layout section is added to the code to avoid repetition of the html -->
<!-- That is why the index, about and services aren't abiding to the normal html syntax -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- loading css from the public asset folder -->
        <!-- check in public>css>app.css -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}"> 
        <!-- configure the title to 'app.name' if it isn't there then it shld use 'LSAPP' -->
        <title>{{config('app.name','LSAPP')}}</title>
    </head>
    <body>
        @include('inc.navbar')
        <div class="container">
        <!-- In order for this to work you'll have to install 'Laravel Blade Snippets' -->
        <!-- Method: ctrl + p; ext install laravel-blade -->
        @include('inc.messages')
        @yield('content')
        </div>

        <!-- We choose the default way (to initiate by name or id) : rather than initiating by jQuery selector : -->
        <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );//we are gonna add the 'article-ckeditor' id in the text-areas that we wanna use the editor
        </script>

    </body>
</html>
