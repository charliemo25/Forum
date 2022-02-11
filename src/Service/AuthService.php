<?php

namespace App\Service;

use App\Entity\User;

class AuthService {

    public static function ValidateUserAuth(User $user, $password){

        $validatePassword = password_verify($password, $user->getPassword());
        
        // La validation a échoué
        if(!$validatePassword){
            return header('Location: /connexion');
        } 

        setcookie("user", $user->getUsername());

    }

}