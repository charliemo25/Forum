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

$userRepository->save(new User(
    id: null,
    lastname: "Moreau",
    firstname: "Charlie",
    username: "Charliemo25",
    password: "password123",
    age: 25,
    role: $roleAdmin
));

$userRepository->save(new User(
    id: null,
    lastname: "Toto",
    firstname: "Toto",
    username: "toto",
    password: "toto",
    age: 18,
    role: $roleUser
));


// $roleRepository->save(new Role(
//     id:null,
//     title: "admin"
// ));

// $roleRepository->save(new Role(
//     id:null,
//     title: "user"
// ));

// $role = $roleRepository->find(1);

// $roles = $roleRepository->findAll();

// echo $role->getTitle()."\n\n";

// foreach ($roles as $r){
//     echo $r->getTitle()."\n";
// }