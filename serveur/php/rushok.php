<?php
require('modele.php');
$tableau=array();

//listetous();
	
function listetous(){
		global $tableau;
		//$listeFilms = $bdd->query('SELECT * FROM films');
		$listeFilms = listetousfilms();
		while($ligne=$listeFilms->fetch(PDO::FETCH_OBJ)){   // on ajoute toutes les lignes fetch au tableau 
			    $tableau[]=$ligne;
		}

}


function categorie($action){
		global $tableau;
		//$listeFilms = $bdd->query('SELECT * FROM films');
		$listeFilms = listeCategorie($action);
		while($ligne=$listeFilms->fetch(PDO::FETCH_OBJ)){   // on ajoute toutes les lignes fetch au tableau 
			    $tableau[]=$ligne;
		}

}





function modifier(){}

$action=$_POST['action'];
	switch($action){
		case "listetousfilms" :
			listetous();
		break;

		case "romantique" :
			categorie($action);
		break;
		
		case "modifier" :
			modifier();
		break;
	}




echo json_encode($tableau);

?>


