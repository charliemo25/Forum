<?php

namespace App\Entity;

class Comment {
    
    public function __construct(
        private ?int $id,
        private string $title,
        private string $message,
        private User $user,
        private Post $post
    )
    {}

    public static function fromArray(array $data): self
    {
        return new Comment(
            id:         $data["id"] ?? null,
            title:      $data["title"] ?? "",
            message:    $data["message"] ?? "",
            user:       $data["user"] ?? null,
            post:       $data["post"] ?? null
        );
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
        return $this;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

}