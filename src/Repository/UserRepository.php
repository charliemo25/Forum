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
            "id" =>         $user->getId(),
            "lastname" =>   $user->getLastname(),
            "firstname" =>  $user->getFirstname(),
            "username" =>   $user->getUsername(),
            "password" =>   $user->getPassword(),
            "age" =>        $user->getAge(),
            "role_id" =>    $user->getRole()->getId()
        ]);
    }

    /**
     * Recherche un utilisateur à partir de son role
     *
     * @param integer $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE id=:id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        if(!$data) {
            return null;
        }

        // Récupération du role
        $role = (new RoleRepository($this->pdo))->find($data["role_id"]);
        $data["role"] = $role;

        return User::fromArray($data);
    }

    /**
     * Récupère la liste des utilisateurs
     *
     * @return void
     */
    public function findAll()
    {
        $results = $this->pdo->query("SELECT * FROM user");
        $rows = $results->fetchAll();

        $users = [];

        foreach($rows as $row){
            // Récupération du role
            $role = (new RoleRepository($this->pdo))->find($row["role_id"]);

            $user = new User(
                id:         $row["id"],
                lastname:   $row["lastname"],
                firstname:  $row["firstname"],
                username:   $row["username"],
                password:   $row["password"],
                age:        $row["age"],
                role:       $role 
            );
            $users[] = $user;
        }
        return $users;
    }
}