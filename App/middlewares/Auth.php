<?php

namespace App\middlewares;
use Lib\Http\BaseMiddleware;

class Auth implements BaseMiddleware
{
    public function handle(): bool
    {
        return true;
    }
}
