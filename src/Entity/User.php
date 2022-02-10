<?php

namespace App\Entity;

class User {
    public function __construct(
        private ?int $id,
        private string $lastname,
        private string $firstname,
        private string $username,
        private string $password,
        private int $age,
        private Role $role
    )
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public static function fromArray(array $data): self
    {
        return new User(
            id:         $data["id"] ?? null,
            lastname:   $data["lastname"] ?? "",
            firstname:  $data["firstname"] ?? "",
            username:   $data["username"] ?? "",
            password:   $data["password"] ?? "",
            age:        $data["age"] ?? '',
            role:       $data["role"] ?? null
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

    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setPassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setAge(int $age)
    {
        $this->age = $age;
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setRole(Role $role)
    {
        $this->role = $role;
        return $this;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

}