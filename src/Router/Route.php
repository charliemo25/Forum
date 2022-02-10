<?php

namespace App\Router;

class Route {

    private array $matches = [];
    private array $params = [];

    public function __construct(
        private string $path,
        private $callable
    )
    {
        $this->path = trim($path, '/');
    }

    public function with($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
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

        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        
        $regex = "#^$path$#i";

        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        
        array_shift($matches);
        $this->matches = $matches;

        return true;
        
    }

    private function paramMatch($match)
    {
        if(isset($this->params[$match[1]]))
        {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

    /**
     * Execute la page avec les paramètres
     *
     * @return void
     */
    public function call()
    {
        if(is_string($this->callable)){

            $params = explode('#', $this->callable);
            $controller = "App\\Controller\\".$params[0]."Controller";
            $controller = new $controller();

            return call_user_func_array([$controller, $params[1]], $this->matches);

            $action = $params[1];
            return $controller->$action();
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }

    public function getUrl(array $params)
    {
        $path = $this->path;
        
        foreach($params as $k => $v){
            $path = str_replace(":$k", $v, $path);
        }

        return $path;
    }
}