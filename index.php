<?php
require 'vendor/autoload.php';

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\PDO\Connexion;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;

// Instance de PDO
$pdo = (new Connexion())->getPdo();

$roleRepository = new RoleRepository($pdo);
$categoryRepository = new CategoryRepository($pdo);
$userRepository = new UserRepository($pdo, $roleRepository);
$postRepository = new PostRepository($pdo, $userRepository, $categoryRepository);
$commentRepository = new CommentRepository($pdo, $postRepository, $userRepository);

$firstUser = $userRepository->find(1);
$secondUser = $userRepository->find(2);

$post = $postRepository->find(1);

var_dump($commentRepository->findAll());