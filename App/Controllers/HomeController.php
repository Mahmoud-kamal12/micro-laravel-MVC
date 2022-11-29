<?php

namespace App\Controllers;

use App\Models\User;
use Lib\Http\Request;
use Lib\View\View;

class HomeController
{
    public function index()
    {
        return View::make('home');
    }
    public function test()
    {

//        dd(request()->get('id'));
        return View::make('home');
    }

    public function createUser()
    {
        $user = User::Create([
            'name' => "Mahmoud Kamal",
            'email' => "mahmoudkamal@gmail.com",
            'password' => password_hash("123456",PASSWORD_BCRYPT)
        ]);
        dd($user->toArray());
    }

    public function users()
    {
        $users = User::all();
        return View::make('users' , ["users" => $users]);
    }
}
