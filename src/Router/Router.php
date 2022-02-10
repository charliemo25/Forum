<?php

namespace App\Router;

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
        echo '<pre>';
        print_r($this->routes);
        echo '<pre>';
    }
}