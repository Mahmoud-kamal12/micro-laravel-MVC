<?php

namespace Lib;

use Lib\Database\Manager;
use Lib\Http\Request;
use Lib\Http\Response;
use Lib\Http\Route;
use Lib\Support\Config;

class Application
{
    protected Route $route;
    protected Request $request;
    protected Response $response;
    protected Manager $manager;
    protected Config $config;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request , $this->response);
        $this->manager = new Manager();
        $this->config = new Config($this->loadConfigurations());
    }

    protected function loadConfigurations()
    {
        foreach(scandir(config_path()) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filename = explode('.', $file)[0];

            yield $filename => require config_path() . $file;
        }

    }

    public function run(){
        $this->manager->connect();
        $this->route->resolve();
    }

    public function __get(string $name)
    {
        if (property_exists($this,$name)){
            return $this->$name;
        }
    }
}
