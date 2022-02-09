<?php

namespace App\Entity;

class Category {
    
    public function __construct(
        private int $id,
        private string $title,
        private string $description
    )
    {}

    public static function fromArray(array $data): self
    {
        return new Category(
            $data['id'] ?? null,
            $data['title'] ?? '',
            $data['description'] ?? ''
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription() :string
    {
        return $this->description;
    }

}