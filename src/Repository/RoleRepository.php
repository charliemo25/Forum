<?php

namespace App\Repository;

use PDO;
use App\Entity\Role;

class RoleRepository
{
    public function __construct(
        private PDO $pdo
    )
    {}

    /**
     * Sauvegarde un nouveau role
     *
     * @param Role $role
     * @return void
     */
    public function save(Role $role)
    {
        $query = $this->pdo->prepare("
            INSERT INTO role
            (title)
            VALUE
            (:title)
        ");

        $query->execute([
            "title" => $role->getTitle()
        ]);
    }

    /**
     * Recherche un role à partir de son id
     *
     * @param integer $id
     * @return Role|null
     */
    public function find(int $id): ?Role
    {
        $query = $this->pdo->prepare("SELECT * FROM role WHERE id=:id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        if(!$data) {
            return null;
        }
        
        return Role::fromArray($data);
    }

    public function findAll(): array
    {
        $results = $this->pdo->query("SELECT * FROM role");
        $rows = $results->fetchAll();

        $roles = [];

        foreach($rows as $row){
            $category = new Role(
                id: $row["id"],
                title: $row["title"]
            );
            $roles[] = $category;
        }
        return $roles;
    }

}