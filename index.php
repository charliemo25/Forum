<?php

use App\Router\Router;

require 'vendor/autoload.php';

$router = new Router($_SERVER["REQUEST_URI"]);


$router->get('/', function(){
    echo "HomePage";
});

$router->get('/posts', "Post#index");

$router->get('/posts/:id', "Post#details");

// $router->get('/posts', function(){
//     echo "Tous les articles";
// });

// $router->get('/posts/:id-:slug', function($id, $slug) use($router){
//     echo $router->url('Posts#show', ["id" => 1, "slug" => "salut-les-gens"]);
// }, 'post.show')->with('id', '[0-9]+')->with('slug', '[a-z\-0-9]+');

// $router->get('/posts/:id', "Posts#show");

// $router->post('/posts/:id', function($id){
//     echo "Poster pour l'article $id <pre>".print_r($_POST, true)."</pre>";
// });

$router->run();