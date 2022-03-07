<?php
ob_start();
require("bdd.php");
include_once("entete.php");

										// 1- VERIFICATION DE L'EXISTENCE DE VARIABLES DE SESSION



echo $_SESSION['confirmkey'];

		 					 /****************************** SUPPRIMER********************************************/
		 						if(isset($_GET['supprimer'])){

		 							$supprimer = $bdd->prepare('DELETE FROM membres WHERE confirmkey = ?');
						   	        $supprimer->execute(array($_GET['supprimer']));
						   	        header("Location: admin.php?nom=".$_SESSION['nom']."&confirmkey=".$_SESSION['confirmkey']);
		 						}

		 						 /****************************** DESACTIVER********************************************/

		 						if(isset($_GET['desactiver'])){
		 							$desactiver = $bdd->prepare('UPDATE  membres SET confirme = 0 WHERE confirmkey = ?');
						   	        $desactiver->execute(array($_GET['desactiver']));
						   	        header("Location: admin.php?nom=".$_SESSION['nom']."&confirmkey=".$_SESSION['confirmkey']);

		 						}

		 						/****************************** ACTIVER********************************************/

		 						if(isset($_GET['activer'])){
		 							$activer = $bdd->prepare('UPDATE  membres SET confirme = 1 WHERE confirmkey = ?');
						   	        $activer->execute(array($_GET['activer']));
						   	        header("Location: admin.php?nom=".$_SESSION['nom']."&confirmkey=".$_SESSION['confirmkey']);
		 							
		 						}

	
		/**************************************************************************/










ob_end_flush();
?>