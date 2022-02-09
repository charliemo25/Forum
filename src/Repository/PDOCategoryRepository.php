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


    public function save(Category $category)
    {
        $query = $this->pdo->prepare("
            INSERT INTO category
            (title, description)
            VALUE
            (:title, :description)
        ");

        $query->execute([
            "title" => $category->getTitle(),
            "description" => $category->getDescription()
        ]);
    }

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

    public function findAll(): array
    {
        $results = $this->pdo->query("SELECT * FROM category");
        $rows = $results->fetchAll();

        $categories = [];

        foreach($rows as $row){
            $category = new Category(
                $row["id"],
                $row["title"],
                $row["description"]
            );
            $categories[] = $category;
        }
        return $categories;
    }

}