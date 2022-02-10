<?php
require 'vendor/autoload.php';

use App\Entity\Post;
use App\Entity\User;
use App\PDO\Connexion;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;

// Instance de PDO
$pdo = (new Connexion())->getPdo();

$roleRepository = new RoleRepository($pdo);
$categoryRepository = new CategoryRepository($pdo);
$userRepository = new UserRepository($pdo, $roleRepository);
$postRepository = new PostRepository($pdo, $userRepository, $categoryRepository);

$firstUser = $userRepository->find(1);
$secondUser = $userRepository->find(2);

$category = $categoryRepository->find(1);

// $postRepository->save(new Post(
//     id:         null,
//     title:      "Le meilleur post",
//     user:       $firstUser,
//     category:   $category
// ));

// $postRepository->save(new Post(
//     id:         null,
//     title:      "Le plus nul post",
//     user:       $secondUser,
//     category:   $category
// ));

var_dump($postRepository->findAll());