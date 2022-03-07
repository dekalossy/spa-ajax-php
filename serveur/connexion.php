<?php
ob_start();
require("bdd.php");     // connexion à la base de données.
include_once("entete.php");


$emailConnect=htmlspecialchars($_POST['emailConnect']);     // //sécurisation  données envoyées par le client
$pswdConnect=sha1($_POST['pswdConnect']);




	if(!empty($emailConnect) AND !empty($pswdConnect)){   // On reverifie que le formulaire est renseigné.

		$requser=$bdd->prepare('SELECT * FROM membres WHERE courriel = ? AND motDePasse = ?');
		$execute=$requser->execute(array($emailConnect, $pswdConnect));
		$userExist=$requser->rowCount();

		if($userExist==1){          //  => correspondance trouvée dans la base

			     $utilisateur = $requser->fetch();      // stockage de la ligne correspondante dans tableau utilisateur

			     if ($utilisateur['confirme']==1) {

			     	$_SESSION['id'] = $utilisateur['id'];              // CREATION DES VARIABLES DE SESSION
            	    $_SESSION['nom'] = $utilisateur['nom'];
            	    $_SESSION['courriel'] = $utilisateur['courriel'];
            	    $_SESSION['confirmkey'] = $utilisateur['confirmkey'];

	            	    if($_SESSION['courriel']=='admin@amtfilm.ca'){
	            	    	header("Location: admin.php?nom=".$_SESSION['nom']."&confirmkey=".$_SESSION['confirmkey']);
	            	    }
	            	    else{
	            	    	header("Location: membres.php?nom=".$_SESSION['nom']."&confirmkey=".$_SESSION['confirmkey']); 
	            	        // redirigé vers profil.php mais nous lui envoyons aussi informations de id  confirmkey qui nous permettra de maintenir la session . Cela aurait pu être le nom ou autre.

	            	    }


	            	   
 
			     	
			     }
			     else{								// courriel user non confirmé

			     	echo "Veuillez confirmer votre inscription dans votre mail!";

			     	?>
						 	<!-------------- courriel user non confirmé ----------------->

							<div class="confirmation">  
								<div class="message">
									
									<div class="msgbox">
										<div class="contenu_box">
											<div class="image_ok">
											<span><i class="fa fa-check-circle" aria-hidden="true" style="color: #82ce34"></i></span> 
											</div>
											<div> <h2> OOPS..! </h2><b><?php echo $emailConnect; ?></b>
											</div>
											<div> <p>Compte non confirmé. <br/>Veuillez confirmer votre inscription dans votre mail.! <br/> Vérifier aussi vos spams.
											</div>
											<button  ><a href="#" data-toggle="modal" data-target="#demoModal">Se connecter</a> </button>
										</div>
									</div>
								</div>
							</div>


						 	<?php


			     }

		}
		else{

			echo "Mauvais identifiant ou mot de passe!";

			?>				
						<!-------------- mauvais courriel ou mot de  passe ----------------->

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

		}




	}
	else{
		echo "Veuillez remplir tous les champs";
	}
ob_end_flush();
?>