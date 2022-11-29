<?php

namespace App\middlewares;
use Lib\Http\BaseMiddleware;

class Admin implements BaseMiddleware
{
    public function handle(): bool
    {
        return true;
    }
}
