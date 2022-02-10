<?php

use App\Router\Router;

require 'vendor/autoload.php';

$router = new Router($_SERVER["REQUEST_URI"]);


$router->get('/', function(){
    echo "HomePage";
});
$router->get('/posts', function(){
    echo "Tous les articles";
});
$router->get('/posts/:id', function($id){
    echo "Afficher l'article $id";
});
$router->post('/posts/:id', function($id){
    echo "Poster pour l'article $id";
});

$router->run();