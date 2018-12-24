<?php
require_once "conf/ConnectionFactory.php";

Class Query {

	private $sqltable;
	private $fields ='*';
	private $where = null;
	private $args = [];
	private $sql = '';

	//---------------------------------------------------------

	/* function qui créé une instance de Query et stocke le nom
	   de la table concernée ; retourne le nouvel objet Query */

	public static function table($table)
	{
		$query = new Query;
		$query->sqltable= $table;
		return $query;
	}

	//---------------------------------------------------------

	/* function qui permet de choisir les colonnes 
		dans le résultat */

	public function select( array $fields)
	{
		$this->fields = implode(',', $fields);
		return $this;
	}

	//---------------------------------------------------------

	/* qui reçoit 3 paramètres correspondant aux composant d'une
	   condition et stocke cette condition dans la requête ; 
	   retourne l'objet Query courant */

	public function where($col,$op,$val)
	{
		if(!is_null($this->where)) 
			$this->where .=' and ';
		
		$this->where .= $col . ' ' .$op .' ? ';
		$this->args[] = $val;
		return $this;
	}

	//---------------------------------------------------------

	/* qui construit le texte complet de la requête et son tableau
	   d'arguments, et affiche cette requête. */

	public function get()
	{
		$this->sql = 'SELECT '. $this->fields . ' FROM '.$this->sqltable ;
		if(!is_null($this->where)) $this->sql .= ' WHERE ' . $this->where;
		
		$pdo = ConnectionFactory::getConnection();
		$stmt = $pdo->prepare($this->sql);

		for($i = 0 ; $i < count($this->args); $i++){
			$stmt->bindParam($i+1,$this->args[$i]);
		}

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	//---------------------------------------------------------

	/* function qui permet de supprimer une ligne dans une table */
	
	public function delete()
	{
		$this->sql = 'delete from ' . $this->sqltable;
		if(!is_null($this->where)) $this->sql .= ' WHERE ' . $this->where;

		$pdo = ConnectionFactory::getConnection();

		$stmt = $pdo->prepare($this->sql);

		foreach($this->args as $k => $a){
			$stmt->bindParam($k+1,$a);
		}
		$stmt->execute();

	}

	//---------------------------------------------------------

	/* function qui reçoit en paramètre un tableau et insère 
	   ce tableau comme une nouvelle ligne dans la table */

	public function insert($tb)
	{
		$this->tb = implode(',', $tb);
		$this->sql = 'insert into '. $this->sqltable.' (';

		$bind = [];

		foreach($tb as $k => $v){
			$this->sql .= "$k,";
			$bind[] = $v;
		}

		$this->sql = rtrim($this->sql,",");

		$this->sql .= ')';

		//-------------
		
		$this->sql .= ' values (';
		foreach($tb as $k){
			$this->sql .= '?,';
		}

		$this->sql = rtrim($this->sql,",");

		$this->sql .= ')';
		
		$pdo = ConnectionFactory::getConnection();

		$stmt = $pdo->prepare($this->sql);

		$stmt->execute($bind);
		
		return $pdo->lastInsertId();
	}

	//---------------------------------------------------------

}


?>