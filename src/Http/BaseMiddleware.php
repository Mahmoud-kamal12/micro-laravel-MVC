<?php

namespace Lib\Http;

interface BaseMiddleware
{
    public function handle():bool;
}
