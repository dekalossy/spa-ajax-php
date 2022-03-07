<?php                              /* demarrage de session et declaration de la base*/
session_start();
    $host = "localhost";
    $dbname = "a20bdfilms";
    $user = "root";
    $pass = "password";

    try {
    	// On se connecte à la base de données
      $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';port=3308;charset=utf8', $user, $pass);

    }

    catch(Exception $e)
	{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
	}
?>