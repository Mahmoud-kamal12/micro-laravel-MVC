<?php

use \Lib\Application;
use \Lib\Http\Request;
use \Lib\Support\Hash;
use \Lib\Support\Auth;
use \Lib\Http\Response;

if (!function_exists('env')){
    function env($key , $default = ''){
        return $_ENV[$key] ?? null;
    }
}

if (!function_exists('value')){
    function value($value){
        return ($value instanceof Closure) ? $value() : $value;
    }
}

if (!function_exists('base_path')){
    function base_path(): string
    {
        return dirname(__DIR__) . "/../";
    }
}

if (!function_exists('view_path')){
    function view_path(): string
    {
        return base_path() . "views/";
    }
}

if (!function_exists('database_path')){
    function database_path(): string
    {
        return base_path() . "database/";
    }
}

if (!function_exists('migration_path')){
    function migration_path(): string
    {
        return database_path() . "migrations/";
    }
}

if (!function_exists('app')){
    function app()
    {
        static $instance = null;
        if (!$instance){
            $instance = new Application();
        }
        return $instance;
    }
}

if (!function_exists('auth')){
    function auth()
    {
        static $instance = null;
        if (!$instance){
            $instance = new Auth();
        }
        return $instance;
    }
}

if (!function_exists('back')) {
    function back()
    {
        return (new Response)->back();
    }
}

if (!function_exists('response')) {
    function response()
    {
        return new Response();
    }
}

if (!function_exists('request')) {
    function request($key = null)
    {
        $instance = new Request;

        if (!$instance) {
            return new Request;
        }

        if ($key) {
            if (is_string($key)) {
                return $instance->get($key);
            }

            if (is_array($key)) {
                return $instance->only($key);
            }
        }

        return $instance;
    }
}

if (!function_exists('config')) {
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app()->config;
        }

        if (is_array($key)) {
            return app()->config->set($key);
        }

        return app()->config->get($key, $default);
    }
}


if (!function_exists('config_path')) {
    function config_path()
    {
        return base_path() . 'config/';
    }
}

if (!function_exists('public_path')) {
    function public_path()
    {
        return base_path() . 'public/';
    }
}

if (!function_exists('assets')) {
    function assets($path): string
    {
        return "/" . $path;
    }
}

if (!function_exists('bcrypt')) {
    function bcrypt($data)
    {
        return Hash::make($data);
    }
}


