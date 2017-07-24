<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


// Route for the middle ware to provide the security to the project .............


//Route::group(['middleware'=>'admin'],function(){

    Route::resource('/admin/users','AdminUsersController');

    Route::resource('/admin/posts','AdminPostsController');


//});


// ..................... finish +++++++++++++++++++++++++++++++++++++++++++ //





Route::get('/admin',function(){

    return view('admin.index');

});