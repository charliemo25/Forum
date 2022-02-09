<?php

namespace App\Repository;

use App\Entity\Category;
use PDO;

class CategoryRepository
{
    public function __construct(
        private PDO $pdo
    )
    {}

    /**
     * Sauvegarde une nouvelle categorie
     *
     * @param Category $category
     * @return void
     */
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

    /**
     * Recherche une categorie à partir de son id
     *
     * @param integer $id
     * @return Category|null
     */
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

    /**
     * Retoure la liste des categories
     *
     * @return array
     */
    public function findAll(): array
    {
        $results = $this->pdo->query("SELECT * FROM category");
        $rows = $results->fetchAll();

        $categories = [];

        foreach($rows as $row){
            $category = new Category(
                id: $row["id"],
                title: $row["title"],
                description: $row["description"]
            );
            $categories[] = $category;
        }
        return $categories;
    }

}