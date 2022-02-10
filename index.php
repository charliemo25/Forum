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
    ?>
    <form action="" method="POST">
        <input type="text" name="name">
        <button type="submit">Envoyer</button>
    </form>
    <?php
});
$router->post('/posts/:id', function($id){
    echo "Poster pour l'article $id <pre>".print_r($_POST, true)."</pre>";
});

$router->run();