<?php
require 'vendor/autoload.php';

use App\PDO\Connexion;
use App\Entity\Category;
use App\Repository\PDOCategoryRepository;

// Instance de PDO
$pdo = (new Connexion())->getPdo();

$categoryRepository = new PDOCategoryRepository($pdo);

$categoryRepository->save(new Category(
    "Test",
    "Lorem ipsum truc machin"
));