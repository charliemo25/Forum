<?php

namespace App\Controller;

use App\Entity\User;
use App\PDO\Connexion;
use App\Repository\RoleRepository;
use PDO;
use App\Repository\UserRepository;

class AuthController {

    private PDO $pdo;
    private RoleRepository $roleRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->pdo = (new Connexion())->getPdo();
        $this->roleRepository = new RoleRepository($this->pdo);
        $this->userRepository = new UserRepository($this->pdo, $this->roleRepository);
    }

    public function connexion(){

        $username = "charliemo25";
        $password = "password123";
        $hash = password_hash($password, null);
        /** @var User $user */
        $user = $this->userRepository->findUser($username);

        // echo "blabla";
        echo var_dump(password_verify($password, $hash));

        // L'utilisateur n'existe pas
        // if(!$user) return header('Location: /');
        
        

    }

}