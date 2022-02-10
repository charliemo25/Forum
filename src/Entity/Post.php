<?php

namespace App\Entity;

class Post {
    public function __construct(
        private ?int $id,
        private string $title,
        private User $user,
        private Category $category
    )
    {}

    public static function fromArray(array $data): self
    {
        return new Post(
            id:         $data["id"] ?? null,
            title:      $data["title"] ?? "",
            user:       $data["user"] ?? null,
            category:   $data["category"] ?? null
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

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }
}