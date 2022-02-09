<?php

namespace App\PDO;

use PDO;
use PDOException;

class Connexion {

    private $pdo;

	public function __construct(
        private string $db, 
        private string $login ='root', 
        private string $pass=''
    ){
		$this->db = $db;
		$this->connexion();
	}

	private function connexion(){
		try
		{
	         $bdd = new PDO(
                            'mysql:host=localhost;dbname='.$this->db.';charset=utf8', 
                             $this->login, 
                             $this->pass
                 );
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$this->pdo = $bdd;
            echo "Vous êtes bien connecter à la base de données $this->db.";

		}
		catch (PDOException $e)
		{
			$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
			die($msg);
		}
	}

    public function getPdo(){
        return $this->pdo;
    }

}