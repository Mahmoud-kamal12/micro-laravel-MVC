<?php

namespace Lib\Support;

use App\Models\User;

class Auth
{
    public static User $user;

    public static function login(User $user){

    }

    public static function logout(){

    }

    public static function check(User $user){

    }

    public static function user(): User
    {
        return self::$user;
    }



}
