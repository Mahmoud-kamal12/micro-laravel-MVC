<?php

namespace Lib\Database;

class DB
{

    public static function migrate() {
        include dirname(__DIR__) . "/../vendor/autoload.php";
        $manager = new Manager();
        $manager->connect();
        $migrationPath = dirname(__DIR__) . "/../database/migrations";
        foreach (scandir($migrationPath) as $file){
            if ($file != '.' and $file != '..'){

                echo "\e[33mMigrating: ";
                echo "\e[39m{$file} \n";
                include $migrationPath . "/" . $file;
                echo "\e[92mMigrated: ";
                echo "\e[39m{$file} \n";
            }
        }
    }
}
