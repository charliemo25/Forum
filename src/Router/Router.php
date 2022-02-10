<?php

namespace App\Router;

use Exception;

class Router {
    public function __construct(
        private string $url,
        private array $routes = []
    )
    {}

    public function get(string $path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes["GET"][] = $route;
    }

    public function post(string $path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes["POST"][] = $route;
    }

    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        /** @var Route $route */
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->match($this->url)){
                return $route->call();
            }
        }

        throw new RouterException('No matching routes');
    }
}