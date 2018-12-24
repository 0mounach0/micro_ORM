<?php
require_once 'Model.php';

class Article extends Model {

    protected static $table = 'article';
    protected static $idColumn = 'id';
    

    //---------------------------------------------------------

    /* la méthode categorie() de la classe Article, 
       qui retourne la categorie d'un article */

    public function categorie(){

         return $this->belongs_to('Categorie', 'id_categ');
         
    }

    //---------------------------------------------------------



    
}
?>