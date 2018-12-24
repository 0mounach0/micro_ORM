<?php

require_once "query/Query.php";

class Model {

    protected static $table;
    protected static $idColumn;

    protected $tab_attr = [];

    //---------------------------------------------------------

    /* le constructeur reçoit un paramètre optionnel qui est 
       un tableau d'attributs */

    public function __construct($t = null) {
        if (!is_null($t)) 
            $this->tab_attr = $t;
    }

    //---------------------------------------------------------

    /* l'accesseur pour accéder les valeurs des attributs du modèle */

    public function __get($attr_name){
        if(array_key_exists($attr_name, $this->tab_attr)){
            return $this->tab_attr[$attr_name];
        }else if(method_exists($this, $attr_name)){
            return $this->$attr_name();
        }
    }

    //---------------------------------------------------------

    /* l'accesseur pour modifier les valeurs des attributs du modèle */

    public function __set($attr_name,$attr_val){
        if(array_key_exists($attr_name, $this->tab_attr)){
            $this->tab_attr[$attr_name] = $attr_val;
        }
    }

    //---------------------------------------------------------

    /*  la méthode permet de supprimer les données dans la base
        correspondant à l'objet */

    public function delete(){

        if(array_key_exists($this::$idColumn, $this->tab_attr)){

            if(is_int($this->tab_attr[$this::$idColumn])){

                Query::table($this::$table)
                        ->where($this::$idColumn, '=', $this->tab_attr[$this::$idColumn])   
                        ->delete();

            }
        }
    }

    //---------------------------------------------------------

    /* la methode qui transforme l'objet courant en une ligne de table */

    public function insert(){
        
        $this->tab_attr[$this::$idColumn] = Query::table($this::$table)
                                                    ->insert($this->tab_attr);
        
    }


    //---------------------------------------------------------

    /* la méthode all() qui retourne l'ensemble des lignes de 
       la table sous la forme d'un tableau de modèles */

    public static function all(){
        
        $liste = Query::table(static::$table)
		        ->select(['*'])
                ->get();

        $res = [];

        $className = static::class;

        foreach($liste as $l){
                $res[] = new $className($l); 
        }
        
        return $res;
       
    }

    //---------------------------------------------------------

    /* la méthode find() qui permet de sélectionner des lignes dans 
       la base et retourne toujours un tableau d'objets modèles */
    
       public static function find($args,$params = null){

        if($params == null){
            $liste = Query::table(static::$table)
                ->select(['*']);
        }else{
            $liste = Query::table(static::$table)
                ->select($params);
        }

        if(is_int($args)){
            $liste = $liste->where(static::$idColumn,'=',$args);
        }else if(is_string($args[0])){
            $liste = $liste->where($args[0],$args[1],$args[2]);
        }else{
            foreach ($args as $key => $arg) {
                $liste = $liste->where($arg[0],$arg[1],$arg[2]);
            }
        }

        $liste = $liste->get();

        $res = [];

        $className = static::class;

        foreach($liste as $l){
                $res[] = new $className($l); 
        }
        
        return $res;

    }

    //---------------------------------------------------------

    /* la méthode first() qui est identique à find() mais retourne
       uniquement le 1er élément du tableau d'objets produit par find() */
    
       public static function first($args,$params = null){

        $res = static::find($args,$params);

        return $res[0];

    }

    //---------------------------------------------------------

    /* la méthode belongs_to() qui permet de suivre une association 
       de multiplicité 1 */
    
       public function belongs_to($model, $id){

        $res = new $model();

        $liste = Query::table($res::$table)
                ->select(['*']);

        $liste = $liste->where($res::$idColumn,'=',$this->$id);

        $liste = $liste->get();
        
        $res = [];

        $className = static::class;

        foreach($liste as $l){
                $res[] = new $className($l); 
        }
        
        return $res[0];
        
    }

    //---------------------------------------------------------

    /* la méthode has_many() qui permet de suivre une 
       association de multiplicité n */
    
       public function has_many($model, $id){

        $res = new $model();

        $liste = Query::table($res::$table)
                ->select(['*']);

        $liste = $liste->where($id,'=',$this->id);

        $liste = $liste->get();
        
        $res = [];

        $className = static::class;

        foreach($liste as $l){
                $res[] = new $className($l); 
        }
        
        return $res;
        
    }

    //---------------------------------------------------------

}
?>