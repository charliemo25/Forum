<?php

namespace App\Repository;

use PDO;
use App\Entity\User;

class UserRepository
{
    public function __construct(
        private PDO $pdo
    )
    {}

    /**
     * Sauvegarde un nouvel utilisateur
     *
     * @param User $user
     * @return void
     */
    public function save(User $user)
    {
        $query = $this->pdo->prepare("
            INSERT INTO user
            (id, lastname, firstname, username, password, age, role_id)
            VALUE
            (:id, :lastname, :firstname, :username, :password, :age, :role_id)
        ");

        $query->execute([
            "id" => $user->getId(),
            "lastname" => $user->getLastname(),
            "firstname" => $user->getFirstname(),
            "username" => $user->getUsername(),
            "password" => $user->getPassword(),
            "age" => $user->getAge(),
            "role_id" => $user->getRole()->getId()
        ]);
    }
}