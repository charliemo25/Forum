<?php

namespace App\Repository;

use App\Entity\Category;
use PDO;

class PDOCategoryRepository
{
    public function __construct(
        private PDO $pdo
    )
    {}

    public function find(int $id): ?Category
    {
        $query = $this->pdo->prepare("SELECT * FROM category WHERE id=:id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        if(!$data) {
            return null;
        }
        
        return Category::fromArray($data);
    }
}