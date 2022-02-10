<?php

namespace App\PDO;

use PDO;
use PDOException;

include_once("./config.php");

class Connexion {

    private PDO $pdo;

	public function __construct(
        private string $db = DB_NAME, 
        private string $login = LOGIN, 
        private string $pass= PASSWORD
    ){
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
			$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->pdo = $bdd;

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