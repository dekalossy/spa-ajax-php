<?php
require("bdd.php");
include_once("entete.php");
// Cette page fait des vérifications et ensuite affiche les messages correspondants.

// 1-  Vérifications si l'url contient le $nom et la $cle
//-2-  Etat de confirmation 
//-3-  Confirmation sinon

if(isset($_GET['nom'], $_GET['cle']) AND !empty($_GET['nom']) AND !empty($_GET['cle'])){

	  $nom = htmlspecialchars(urldecode($_GET['nom']));
	  $cle = htmlspecialchars($_GET['cle']);

	  $reqNom = $bdd->prepare('SELECT * FROM membres WHERE nom = ? AND confirmkey = ?');
	  $ReqNom = $reqNom->execute(array($nom, $cle ));
	  $nomExist = $reqNom->rowCount();

	  		if($nomExist==1){   //  => correspondance trouvée dans la base

	  						$utilisateur = $reqNom->fetch();      // stockage de la ligne correspondante dans tableau utilisateur

	  					if ($utilisateur['confirme']==0) {
	  						$mailEnreg = $utilisateur['courriel'];    

	  						$confirmation = $bdd->prepare('UPDATE membres SET confirme = 1 WHERE nom = ? AND confirmkey = ?' );
	  						$confirmation = $confirmation->execute(array($nom, $cle));


						 	?>
						 	<!-------------- CONFIRMATION REUSSIE ----------------->

							<div class="confirmation">  
								<div class="message">
									
									<div class="msgbox">
										<div class="contenu_box">
											<div class="image_ok">
											<span><i class="fa fa-check-circle" aria-hidden="true" style="color: #82ce34"></i></span> 
											</div>
											<div> <h2> FÉLICITATION..! </h2><b><?php echo  $nom; ?></b>
											</div>
											<div> <p>Votre compte été bien confirmé avec le courriel <br/> <b><?php echo $mailEnreg; ?></b> 
												 Essayez de vous connecter à présent.</div>
											<button  ><a href="#" data-toggle="modal" data-target="#demoModal">Se connecter</a> </button>
										</div>
									</div>
								</div>
							</div>


						 	<?php
	  							
	  					}
	  					else
	  					{
	  						$erreur1; /* compte déjà confirmé */

							?>

							<div class="confirmation">
								<div class="message">
									<div class="msgbox">
										<div class="contenu_box">
											<div class="image_ok">
												<span><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red"></i> </span> 
											</div>
											<div> <h2> Compte existant! </h2>
											</div>
											<div> <p> Votre compte a déjà été confirmé.<br/>
												 Connectez-vous avec vos identifiants.</div>
											<button  ><a href="#" data-toggle="modal" data-target="#demoModal">Se connecter</a> </button>
										</div>
									</div>
								</div>
							</div>

							<?php

	  					}

	  		}

	  		else{  //  => correspondance non trouvée dans la base, compte non existant. 

	  			header("location:confirmation_failed.php");


	  			?>

							<div class="confirmation">
								<div class="message">
									<div class="msgbox">
										<div class="contenu_box">
											<div class="image_ok">
												<span><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red"></i> </span> 
											</div>
											<div> <h2> Compte inexistant! </h2>
											</div>
											<div> <p> Ce compte est inexistant.<br/>
												 Essayez d'en créer un...!</div>
											<button  ><a href="#" data-toggle="modal" data-target="#nouveauMembreModal">accueil</a> </button>
										</div>
									</div>
								</div>
							</div>

							<?php


	  		}



}
else{								// utilisation tentant de se connecter sans url valide.
	header('location:../index.html');

}



?>