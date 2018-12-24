<?php

//Gestion de la connexion à la base
Class ConnectionFactory
{
	public static $cnx;

	//---------------------------------------------------------

	/* méthode reçoit un tableau contenant les
	   paramètres de connexion, établit cette connexion en 
	   créant un objet PDO, stocke cet objet dans une variable 
	   statique et la retourne en résultat. */

	public static function makeConnection($config)
	{
		$init = parse_ini_file($config);

		$serveur = $init["host"];
		$base = $init["name"];
		$user = $init["user"];
		$pass = $init["pass"];
		$type = $init["type"];

		$dsn = "$type:host=$serveur;dbname=$base";

			$db = new \PDO($dsn,$user,$pass);
			self::$cnx = $db;
			return self::$cnx;
	}

	//---------------------------------------------------------

	/*  méthode retourne le contenu de la variable statique */
	
	public static function getConnection(){
		return self::$cnx;
	}

	//---------------------------------------------------------

}