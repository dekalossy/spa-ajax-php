<?php
//require("bdd.php");
 //(« _ »)Ceci est une notation qu'il est préférable de respecter (il s'agit de la notation PEAR) qui dit que chaque nom d'élément privé (ici il s'agit d'attributs, mais nous verrons plus tard qu'il peut aussi s'agir de méthodes) doit être précédé d'un underscore.   
	
function dbconnect(){
	$host = "localhost";
    $dbname = "a20bdfilms";
    $user = "root";
    $pass = "password";

    try {
    	// On se connecte à la base de données
      $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';port=3308;charset=utf8', $user, $pass);
      return $bdd;
        
        
    }

    catch(Exception $e)
	{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
	}
}





function listetousfilms(){
	$bdd = dbconnect();
	$listeFilms = $bdd->query('SELECT * FROM films ORDER BY titre LIMIT 10');
	
	return $listeFilms;

}

function listetousmembres(){
	$bdd = dbconnect();
	$listeMembres = $bdd->query('SELECT * FROM membres ORDER BY nom');
	
	return $listeMembres;

}






function listeCategorie($categFilm){
	$bdd = dbconnect();
	$listeFilms = $bdd->prepare('SELECT * FROM films WHERE categorie = ?');
	$listeFilms->execute(array($categFilm));
	
	return $listeFilms;

}


function insererfilm($categFilm, $titreFilm, $realisateurFilm, $dureeFilm, $dateFilm, $pochette, $url, $synopsys, $prix){
	$bdd = dbconnect();
	$enregistrementFilms = $bdd->prepare('INSERT INTO films (categorie, titre, realisateur, duree, dateFilm, pochette, url, synopsys, prix) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
	$enregistrementFilms->execute(array($categFilm, $titreFilm, $realisateurFilm, $dureeFilm, $dateFilm, $pochette, $url, $synopsys, $prix));
	move_uploaded_file($_FILES['pochette']['tmp_name'], '../pochettes/'.$pochette);

		  

}















/* L'opérateur « -> » permet d'accéder à un élément de tel objet, tandis que l'opérateur « :: » permet d'accéder à un élément de telle classe.

**Au sein d'une méthode, on accède à l'objet grâce à la pseudo-variable $this, tandis qu'on accède à la classe grâce au mot-clé self.

**Les attributs et méthodes statiques ainsi que les constantes de classe sont des éléments propres à la classe, c'est-à-dire qu'il n'est pas utile de créer un objet pour s'en servir.

**Les constantes de classe sont utiles pour éviter d'avoir un code muet, c'est-à-dire un code qui, sans commentaire, ne nous informe pas vraiment sur son fonctionnement.

**Les attributs et méthodes statiques sont utiles lorsque l'on ne veut pas avoir besoin d'un objet pour s'en servir.*/
