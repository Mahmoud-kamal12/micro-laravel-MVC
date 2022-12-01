<?php

namespace Lib\Http;

use Lib\Http\Request;
use Lib\Http\Response;
use Lib\Support\Arr;
use Lib\View\View;

class Route{

    public static array $routes = [];
    public static array $middlewares = [];
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    function matchRoute($routes , $path): bool|array
    {
        foreach ($routes as $key => $val){
            $params = [];
            $num = 0;
            $indexes = [];
            $arrayKey = explode('/' , trim($key , '/'));
            $arrayPath = explode('/' , trim($path , '/'));

            foreach ($arrayKey as $index  => $item){
                if (
                    (isset($item[0]) && $item[0] == '{') &&
                    (isset($item[strlen($item) - 1]) && $item[strlen($item) - 1] == '}') &&
                    (isset($item[strlen($item) - 2]) && $item[strlen($item) - 2] == '?')
                    ){
                    $num++;
                    $indexes[] = $index;
                }
            }

            $check = ((count($arrayKey) === count($arrayPath)) || ((count($arrayKey) - $num) == count($arrayPath)) );

            if ($check){


                if (count($arrayKey) === count($arrayPath) - $num){
                    foreach ($indexes as $index){
                        $arrayPath = Arr::addToIndex([] , 0 , $index , $arrayPath , '?');
                    }
                }

                foreach ($arrayKey as $index => $item){
                    if (
                        (isset($item[0]) && $item[0] == '{') &&
                        (isset($item[strlen($item) - 1]) && $item[strlen($item) - 1] == '}')
                    ){
                        $params[] = $arrayPath[$index] ?? null;
                        $arrayKey[$index] = '';
                        $arrayPath[$index] = '';
                    }
                }

            }
            if (strcmp(implode($arrayKey) , implode($arrayPath)) === 0)
                return [$key , $params];
        }
        return false;
    }

    public static function get($route , $action , $middleware= [])
    {
        self::$routes['get'][$route]   = $action;
        self::$middlewares['get'][$route] = Arr::flatten($middleware);
    }

    public static function post($route , $action , $middleware= [])
    {
        self::$routes['post'][$route] = $action;
        self::$middlewares['post'][$route] = Arr::flatten($middleware);

    }

    public static function delete($route , $action , $middleware= [])
    {
        self::$routes['delete'][$route] = $action;
        self::$middlewares['delete'][$route] = Arr::flatten($middleware);

    }

    public static function put($route , $action , $middleware= [])
    {
        self::$routes['put'][$route] = $action;
        self::$middlewares['put'][$route] = Arr::flatten($middleware);

    }

    private static  function getMiddleware($route , $method): array
    {
        $temp = [];
        $middlewares = self::$middlewares[$method][$route] ?? [];
        foreach( $middlewares as  $middleware){
            $middleware = $middleware ? config('app.middlewares')[$middleware] ?? false : false;
            $key = $middleware ? new $middleware instanceof BaseMiddleware ? $middleware : false: false;
            $temp[$key] = $middleware;
        }
        return [!Arr::has($temp , false) , $temp];
    }

    public function resolve(){
        $path = $this->request->path();
        $method = $this->request->method();

        [$path ,$params]= self::matchRoute(self::$routes[$method] , $path);

        $action = self::$routes[$method][$path] ?? false;
        [ $check , $middlewares] = self::getMiddleware($path , $method);
        if (!$check){
            View::makeError('404');
        }
        else{
            $break = true;
            foreach ($middlewares as $middleware){
                if (!call_user_func_array([new $middleware , 'handle'] , [])){
                    $break = false;
                    View::makeError('403');
                    break;
                }
            }
            if ($break){
                if (!array_key_exists($path , self::$routes[$method])){
                    View::makeError('404');
                } elseif (is_callable($action)){
                    call_user_func_array($action , $params);
                } elseif (is_array($action)){
                    call_user_func_array([new $action[0] , $action[1]],$params);
                }
            }
        }
    }
}
