<?php
require 'vendor/autoload.php';

use App\Entity\User;
use App\PDO\Connexion;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;

// Instance de PDO
$pdo = (new Connexion())->getPdo();

$userRepository = new UserRepository($pdo);
$roleRepository = new RoleRepository($pdo);

$roleAdmin = $roleRepository->find(1);
$roleUser = $roleRepository->find(2);

$users = $userRepository->findAll();

var_dump($users);
// foreach ($roles as $r){
//     echo $r->getTitle()."\n";
// }