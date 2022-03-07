<?php
session_start();         // demarrage de session
$_SESSION = array();     //Vidange des variables de session
session_destroy();		// Fermeture de session
header("location:../index.php");  //redirection
?>