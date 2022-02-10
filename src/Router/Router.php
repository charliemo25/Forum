<?php

namespace App\Router;

use Exception;

class Router {

    private array $routes = [];
    private array $namedRoutes = [];

    public function __construct(
        private string $url
    )
    {}

    public function get(string $path, $callable, string $name = null)
    {
        return $this->add($path, $callable, $name, "GET");
    }

    public function post(string $path, $callable, string $name = null)
    {
        return $this->add($path, $callable, $name, "POST");
    }

    private function add(string $path, $callable, ?string $name, string $method): Route
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;

        if(is_string($callable) && $name === null){
            $name = $callable;
        }

        if($name){
            $this->namedRoutes[$name] = $route;
        }

        return $route;
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

    public function url(string $name, array $params = [])
    {
        if(!isset($this->namedRoutes[$name])){
            throw new RouterException("No route matches this name");
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }
}