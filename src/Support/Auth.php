<?php

namespace Lib\Support;

use App\Models\User;
use Firebase\JWT\JWT;

class Auth
{
    public static User $user;

    public static function login(User $user , $password){
        if (Hash::verify($password ,$user->password)){
            $user->api_key =  base64_encode(bcrypt(uniqid($user->email, true)));
            $user->save();
            $_SESSION['user'] = $user->toArray();
            return true;
        }
        return false;

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
