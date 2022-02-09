<?php
require 'vendor/autoload.php';

use App\Entity\Role;
use App\PDO\Connexion;
use App\Entity\Category;
use App\Repository\RoleRepository;
use App\Repository\CategoryRepository;

// Instance de PDO
$pdo = (new Connexion())->getPdo();

$roleRepository = new RoleRepository($pdo);

// $roleRepository->save(new Role(
//     id:null,
//     title: "admin"
// ));

// $roleRepository->save(new Role(
//     id:null,
//     title: "user"
// ));

$role = $roleRepository->find(1);

$roles = $roleRepository->findAll();

echo $role->getTitle()."\n\n";

foreach ($roles as $r){
    echo $r->getTitle()."\n";
}