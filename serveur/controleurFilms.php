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

function listemembres(){
		global $tableau;
		//$listeFilms = $bdd->query('SELECT * FROM films');
		$listeMembres = listetousmembres();
    
		while($ligne=$listeMembres->fetch(PDO::FETCH_OBJ)){   // on ajoute toutes les lignes fetch au tableau 
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



function enregistrement(){
		global $tableau;
		$titreFilm = htmlspecialchars($_POST['titreFilm']);
		$categFilm = $_POST['categFilm'];
		$realisateurFilm = htmlspecialchars($_POST['realisateurFilm']);
		$dureeFilm = $_POST['dureeFilm'];
		$pochette = $_FILES['pochette']['name'];
		$dateFilm = $_POST['dateFilm'];
		$url = $_POST['url'];
		$synopsys = htmlspecialchars($_POST['synopsys']);
		$prix = $_POST['prix'];

		



		insererfilm($categFilm, $titreFilm, $realisateurFilm, $dureeFilm, $dateFilm, $pochette, $url, $synopsys, $prix);
		
		$tableau['message']= "Enregistrement fait avec succès..!";
		
 }











$action=$_POST['action'];
	switch($action){
		case "listetousfilms" :
			listetous();
		break;
            
        case "listetousmembres" :
			listemembres();

		case "romantique" :
		case "drame" :
		case "action":
		case "suspense":
			categorie($action);
		break;
		
		case "enregistrer" :
			enregistrement();
		break;
	}




echo json_encode($tableau);

?>


