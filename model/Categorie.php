<?php
require_once 'Model.php';

class Categorie extends Model {

    protected static $table = 'categorie';
    protected static $idColumn = 'id';



    //---------------------------------------------------------

    /* la méthode articles() de la classe Categorie, 
       qui retourne tous les articles d'une catégorie  */

    public function articles(){

        return $this->has_many('Article', 'id_categ');
        
    }

    //---------------------------------------------------------




    
}
?>