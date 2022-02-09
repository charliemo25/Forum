<?php

namespace App\Entity;

class Role {
    
    public function __construct(
        private ?int $id,
        private string $title
    )
    {}

    public static function fromArray(array $data): self
    {
        return new Role(
            id: $data["id"] ?? null,
            title: $data["title"] ?? ''
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

}