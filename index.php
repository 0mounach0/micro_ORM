<?php
require_once 'query/Query.php';
require_once "conf/ConnectionFactory.php";

require_once "model/Model.php";
require_once "model/Article.php";
require_once "model/Categorie.php";

$conf = 'conf/config.ini';
ConnectionFactory::makeConnection($conf);


//---------------------------------------------------------

//------insert article-------
$art = new Article(['nom' => 'article 808','descr' => 'desc 808','tarif' => 88, 'id_categ' => 2]);
$art->insert();
echo "\n----------insert article-----------\n";
print_r($art);


//------insert categorie-------
$cat = new Categorie(['nom' => 'cat 808','descr' => 'desc 808']);
$cat->insert();
echo "\n----------insert categorie-----------\n";
print_r($cat);


//---------------------------------------------------------

//-----------delete------------

echo "\n----------delete-----------\n";

$art1 = new Article(['id' => 125]);

print_r($art1);
$art1->delete();


//---------------------------------------------------------

//--------all----------

echo "\n----------all articles-----------\n";

$liste = Article::all();
foreach($liste as $a){
	echo "\n";
	echo $a->nom;
}
echo "\n";
print_r($liste);

//---------------------------------------------------------

//--------find-------------

/* $liste_1 = Article::find([['nom','like','%velo%'],['tarif','>=',59.95]]);*/

echo "\n----------find article-----------\n";

$liste_2 = Article::find(['tarif','>=',59.95]);
foreach($liste_2 as $a){
	echo "\n";
    echo $a->nom;
}
echo "\n\n";
print_r($liste_2);

//---------------------------------------------------------

//--------first-------------
echo "\n----------first-----------\n";

$first = Categorie::first(1);
echo "\n\n";
echo $first->nom;
echo "\n\n";
print_r($first);

//---------------------------------------------------------

//--------belongs_to-------------

echo "\n----------belongs_to-----------\n";

$article_66=Article::first(66);

$categorie_66 = $article_66->belongs_to('Categorie', 'id_categ');

print_r($categorie_66);

//---------------------------------------------------------

//--------has_many-------------

echo "\n----------has_many-----------\n";

$categ = Categorie::first(1) ;
$list_article = $categ->has_many('Article', 'id_categ') ;

foreach($list_article as $a){
    echo "\n";
    echo $a->nom;
    echo "\n";
}
echo "\n";

print_r($list_article);


//---------------------------------------------------------

//--------categorie()-------------

echo "\n----------categorie()-----------\n";

$la_categorie = Article::first(66)->categorie();

echo $la_categorie->nom;
echo "\n";
print_r($la_categorie);

//--------articles()-------------
echo "\n----------articles()-----------\n";

$la_list = Categorie::first(1)->articles();

foreach($la_list as $a){
    echo "\n";
    echo $a->nom;
    echo "\n";
}




//--------6.4-------------
echo "\n----------c->articles-----------\n";

$my_categorie = Categorie::first(1) ;
$my_articles = $my_categorie->articles;


foreach($my_articles as $a){
    echo "\n";
    echo $a->nom;
    echo "\n";
}

//---

echo "\n----------a->categorie-----------\n";

$the_article = Article::first(66) ;
$the_categorie = $the_article->categorie;

echo $the_categorie->nom;
echo "\n";
print_r($the_categorie);