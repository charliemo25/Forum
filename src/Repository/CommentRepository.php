<?php

namespace App\Repository;

use PDO;
use App\Entity\Comment;
use App\Entity\Post;

class CommentRepository
{
    public function __construct(
        private PDO $pdo,
        private PostRepository $postRepository,
        private UserRepository $userRepository
    )
    {}

    /**
     * Sauvegarde un commentaire
     *
     * @param Comment $comment
     * @return void
     */
    public function save(Comment $comment)
    {
        $query = $this->pdo->prepare("
            INSERT INTO comment
            (title, message, user_id, post_id)
            VALUE
            (:title, :message, :user_id, :post_id)
        ");

        $query->execute([
            "title" => $comment->getTitle(),
            "message" => $comment->getMessage(),
            "user_id" => $comment->getUser()->getId(),
            "post_id" => $comment->getPost()->getId()
        ]);
    }

    /**
     * Recherche un commentaire
     *
     * @param integer $id
     * @return Comment
     */
    public function find(int $id): Comment
    {
        $query = $this->pdo->prepare("SELECT * FROM comment WHERE id=:id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        if(!$data) {
            return null;
        }

        // Récupération de l'utilisateur
        $user = $this->userRepository->find($data["user_id"]);
        $data["user"] = $user;

        // Récupération du post
        $post = $this->postRepository->find($data["post_id"]);
        $data["post"] = $post;

        return Comment::fromArray($data);
    }

    /**
     * Récupère la liste des commentaires
     *
     * @return array
     */
    public function findAll(): array
    {
        $results = $this->pdo->query("SELECT * FROM comment");
        $rows = $results->fetchAll();

        $comments = [];

        foreach($rows as $row){
            // Récupération de l'utilisateur
            $user = $this->userRepository->find($row["user_id"]);
            
            // Récupération du post
            $post = $this->postRepository->find($row["post_id"]);

            $comment = new Comment(
                id:         $row["id"],
                title:      $row["title"],
                message:    $row["message"],
                user:       $user,
                post:       $post
            );

            $comments[] = $comment;
        }
        return $comments;
    }
}