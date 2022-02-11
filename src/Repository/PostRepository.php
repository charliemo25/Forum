<?php

namespace App\Repository;

use App\Entity\Post;
use PDO;

class PostRepository {
    public function __construct(
        private PDO $pdo,
        private UserRepository $userRepository,
        private CategoryRepository $categoryRepository
    )
    {}

    /**
     * Sauvegarde un post
     *
     * @param Post $post
     * @return void
     */
    public function save(Post $post)
    {
        $query = $this->pdo->prepare("
            INSERT INTO post
            (title, description, user_id, category_id)
            VALUE
            (:title, :description, :user_id, :category_id)
        ");

        $query->execute([
            "title" => $post->getTitle(),
            "description" => $post->getDescription(),
            "user_id" => $post->getUser()->getId(),
            "category_id" => $post->getCategory()->getId()
        ]);
    }

    /**
     * Recherche un post
     *
     * @param integer $id
     * @return Post|null
     */
    public function find(int $id): ?Post
    {
        $query = $this->pdo->prepare("SELECT * FROM post WHERE id=:id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        if(!$data) {
            return null;
        }

        // Récupération de l'utilisateur
        $user = $this->userRepository->find($data["user_id"]);
        $data["user"] = $user;

        // Récupération de la catégorie
        $category = $this->categoryRepository->find($data["category_id"]);
        $data["category"] = $category;

        return Post::fromArray($data);
    }

    /**
     * Récupère la liste des posts
     *
     * @return array
     */
    public function findAll(): array
    {
        $results = $this->pdo->query("SELECT * FROM post");
        $rows = $results->fetchAll();

        $posts = [];

        foreach($rows as $row){
            // Récupération de l'utilisateur
            $user = $this->userRepository->find($row["user_id"]);
            
            // Récupération de la catégorie
            $category = $this->categoryRepository->find($row["category_id"]);

            $post = new Post(
                id:             $row["id"],
                title:          $row["title"],
                description:    $row["description"],
                user:           $user,
                category:       $category
            );

            $posts[] = $post;
        }
        return $posts;
    }
}