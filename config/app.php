<?php

return [


    'locale' => 'ar',

    'middlewares' => [
        'auth' => \App\middlewares\Auth::class,
        'admin' => \App\middlewares\Admin::class
    ],


];
