<?php
ob_start();
require("bdd.php");     // connexion à la base de données.
include_once("entete.php");


$emailConnect=htmlspecialchars($_POST['emailConnect']);     // //sécurisation  données envoyées par le client
$pswdConnect=sha1($_POST['pswdConnect']);
define('FICHIER', '../donnees/membres.txt');




	if(!empty($emailConnect) AND !empty($pswdConnect)){   // On reverifie que le formulaire est renseigné.


			if(!$file=fopen(FICHIER,"r+")){     // On essaie d'acceder à FICHIER pour vérification  --mode r+

				echo "Problème d'enregistrement..!<br><a href='../index.html'>Accueil</a>";

				exit;										// si impossible on arrête tout.
			}

			else{  /****  la recherche de doublons avant insertion***/


					$userExist=false;
						$ligneFichier=fgets($file);
						while(!feof($file)){
						$tab=explode(';',$ligneFichier);
							if($tab[2]==$emailConnect AND $tab[3]==$pswdConnect){
								$userExist=true;
								$userNom=$tab[0];
							}
							 $ligneFichier=fgets($file);
						}
						fclose($file);


					if($userExist){


					     					             // CREATION DES VARIABLES DE SESSION
		            	    $_SESSION['courriel'] = $emailConnect;
		            	    $_SESSION['nom'] = $userNom;

			            	    if($_SESSION['courriel']=='admin@amtfilm.com'){
			            	    	header("Location: admin.php?nom=".$_SESSION['nom']."&courriel=".$_SESSION['courriel']);
			            	    }
			            	    else{
			            	    	header("Location: membres.php?nom=".$_SESSION['nom']."&courriel=".$_SESSION['courriel']); 
			            	        // redirigé vers profil.php mais nous lui envoyons aussi informations de nom et courriel qui nous permettra de maintenir la session . Cela aurait pu être autre.

			            	    }        	  
//************************************************************************************

					}
					else{
							echo "Mauvais identifiant ou mot de passe!";
						?>


							<div class="confirmation">
								<div class="message">
									
									<div class="msgbox">
										<div class="contenu_box">
											<div class="image_ok">
											<span><i class="fa fa-check-circle" aria-hidden="true" style="color: red"></i></span> 
											</div>
											<div> <h2> DÉSOLÉ </h2>
											</div>
											<div> <p> Mauvais identifiant ou mot de passe!<br/>
												 Réessayez de vous connecter</div>
											<button  ><a href="#" data-toggle="modal" data-target="#demoModal">Se connecter</a> </button>
											
										</div>
									</div>

								</div>
							</div>


						<?php

					}?>

					<?php

			}






	}
	else{
		echo "Veuillez remplir tous les champs";
	}
ob_end_flush();
?>