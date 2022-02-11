<?php

namespace App\Controller;

use App\Entity\User;
use App\PDO\Connexion;
use App\Repository\RoleRepository;
use PDO;
use App\Repository\UserRepository;
use App\Service\AuthService;

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
        include_once './src/Template/Auth/connexion.php';
    }

    public function validateAuth(){
        $username = $_POST["username"];
        $password = $_POST["password"];

        /** @var User $user */
        $user = $this->userRepository->findUser($username);
        AuthService::ValidateUserAuth($user, $password);

        return header('Location: /');

    }

}