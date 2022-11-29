<?php
use \Lib\Http\Route;
use \App\Controllers\HomeController;

Route::get('users', function () {
    return dd('index');
});

Route::post('users/create', function () {
    return dd('users/create');
} , ['auth' , 'admin']);

//Route::get('users/{test}', function ($id) {
//    return dd($id);
//});

Route::get('users/{users}/edit', function ($id) {
    return dd("users/{$id}/edit");
});

Route::get('/' , [HomeController::class , 'index']);
//
//Route::get('test/Mahmoud/home/{id}/user', function () {
//    return dd('/home/{id}/user');
//});
//Route::get('test/Mahmoud/home/user/{id?}', function () {
//    return dd('/home/user/{id?}');
//});
//Route::get('test/Mahmoud/home/user/{name?}/{id?}', function () {
//    return dd('/home/user/{name?}/{id?}');
//});
//Route::get('test/Mahmoud/home/user/{name}/{id?}', function () {
//    return dd('/home/user/{name}/{id?}');
//});
//
//
