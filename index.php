<?php
require 'vendor/autoload.php';

use App\PDO\Connexion;
use App\Repository\PDOCategoryRepository;

// Instance 
$pdo = (new Connexion())->getPdo();

$categoryRepository = new PDOCategoryRepository($pdo);

$category = $categoryRepository->find(1);

echo $category->getDescription();