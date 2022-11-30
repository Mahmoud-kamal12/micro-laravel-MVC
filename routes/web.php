<?php
use \Lib\Http\Route;
use \App\Controllers\HomeController;
use \App\Controllers\UserController;
use \App\Controllers\Auth\AuthController;

Route::get('/' , [HomeController::class , 'index']);


Route::get('/users', [UserController::class , 'index']);

Route::get('users/create', [UserController::class , 'create'] , ['auth' , 'admin']);

Route::post('users', [UserController::class , 'store'] , ['auth']);

Route::get('users/{id}/edit', [UserController::class , 'edit']);

Route::put('users/{id}', [UserController::class , 'update']);

Route::delete('users/{id}', [UserController::class , 'destroy']);

Route::post('auth/login', [AuthController::class , 'login']);





