<?php

namespace Lib\Database;
use Illuminate\Database\Capsule\Manager as Capsule;

class Manager
{

    private Capsule $capsule;
    public function __construct()
    {
        $this->capsule = new Capsule;

    }
//DB_CONNECTION=mysql
//DB_HOST=127.0.0.1
//DB_PORT=3306
//DB_DATABASE=aal
//DB_USERNAME=root
//DB_PASSWORD=
    public function connect(){
        $this->capsule->addConnection([
            "driver" => env("DB_CONNECTION","mysql"),
            "host" => env("DB_HOST" , "127.0.0.1"),
            "database" => env("DB_DATABASE", "mahmoud"),
            "username" => env("DB_USERNAME" ,"root"),
            "password" => env("DB_PASSWORD" , '')
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}
