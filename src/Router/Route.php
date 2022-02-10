<?php

namespace App\Router;

class Route {

    private array $matches;

    public function __construct(
        private string $path,
        private $callable
    )
    {
        $this->path = trim($path, '/');
    }

    /**
     * 
     * Permettra de capturer l'url avec les paramètres 
     * get('/posts/:slug-:id') par exemple
     *
     * @param string $url
     * @return void
     */
    public function match(string $url)
    {
        $url = trim($url, '/');

        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        
        $regex = "#^$path$#i";

        if(!preg_match($regex, $url, $matches)){
            return false;
        }

        array_shift($matches);
        $this->matches = $matches;

        return true;
        
    }

    /**
     * Execute la page avec les paramètres
     *
     * @return void
     */
    public function call(){
        return call_user_func_array($this->callable, $this->matches);
    }
}