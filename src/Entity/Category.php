<?php

namespace App\Entity;

class Category {
    
    public function __construct(
        private string $title,
        private string $description,
        private ?int $id = null
    )
    {}

    public static function fromArray(array $data): self
    {
        return new Category(
            id: $data['id'] ?? null,
            title: $data['title'] ?? '',
            description: $data['description'] ?? ''         
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