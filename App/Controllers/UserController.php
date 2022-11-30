<?php

namespace App\Controllers;

use App\Models\User;
use Lib\Http\Response;
use Lib\View\View;

class UserController
{
    public function index(){
        $users = User::all();
        return View::make('users.index' , ['users' => $users]);
    }

    public function create(){
        return View::make('users.create');
    }

    public function store(){
        dd(request()->all());
        $user = User::Create([
            'email' => request()->get('email'),
            'name' => request()->get('name'),
            'password' => password_hash((string)request()->get('password'),PASSWORD_BCRYPT)
        ]);
        return response()->json($user->toArray());
    }

    public function show($id){
        return User::findOrFail('id',$id);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return View::make('users.edit', ['user' => $user]);
    }

    public function update($id){
        return [User::findOrFail($id) , request()->all() ];
    }

    public function destroy($id){
        return User::findOrFail($id);
    }

}
