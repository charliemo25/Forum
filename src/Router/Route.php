<?php

namespace App\Router;

class Route {

    public function __construct(
        private string $path,
        private $callable
    )
    {}

}