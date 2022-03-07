<?php
require("bdd.php");     // connexion à la base de données.
include_once("entete.php");


/* definition des RegEx qui serviront à tester la conformité des entrées*/

$RegExpNom="/^[a-zA-Z]+(?:['\-\s][a-zA-Z]+)*$/";
$RegExpPrenom="/^[a-zA-Z]{3,10}(?:['\-\s][a-zA-Z]+)*$/";
$RegExpMail="/^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/";
$RegExpSexe="/^[1-2]$/";
$RegExAdresse="/[A-Za-z\d#_!-]{2,100}$/";
$RegExpComment="/^[A-Za-z\d#_!-]{2,200}$/";					//au moins 2 caracteres
$RegExpCodePostal="/^[A-Za-z][0-9][A-Za-z] ?[0-9][A-Za-z][0-9]$/";
$RegExpMotPasse="/^[A-Za-z\d#_!-]{8,20}$/";							// au moins 8 au plus 20
define('FICHIER', '../donnees/membres.txt');// membres.txt contiendra les Informations enregistrees. la constante FICHIER definie  permet d'appeler le fichier correspondant 

//*************************************Récupération des données transmises***************************************

$nom=htmlspecialchars($_POST['nom']);
$prenom=htmlspecialchars($_POST['prenom']);
$mailEnreg=htmlspecialchars($_POST['mailEnreg']);     // Données envoyées par le client
$adresse=htmlspecialchars($_POST['adresse']);
$pswEnreg=$_POST['pswEnreg'];
$pswEnregConfirm=$_POST['pswEnregConfirm'];
$ville=$_POST['ville'];
$codePostal=$_POST['codePostal'];
$province=$_POST['selectProvince'];
$naissance=$_POST['dateNaissance'];

//******************************** 1-Verification si données toujours conformes aux Regex => non corrompues******
$donneesRecues=true;    

if(!preg_match($RegExpNom, $nom) || !preg_match($RegExpPrenom, $prenom) || !preg_match($RegExpMail, $mailEnreg) || !preg_match($RegExpMotPasse, $pswEnreg) || !preg_match($RegExpMotPasse, $pswEnregConfirm) || !preg_match($RegExpCodePostal, $codePostal) || !preg_match($RegExAdresse, $adresse)){

	$donneesRecues=false;         // => données corrompues
}


if(!$donneesRecues){
	

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
								<div> <p><b>Données corrompues</b><br/>
									 Essayez de vous inscrire à nouveau</div>
								<button  ><a href="../index.html">Accueil</a> </button>
								
							</div>
						</div>

					</div>
				</div>
<?php
exit;

}
else{  // ************* 2- Vérification d'abscence de doublons de courriel avant insertion dans la base*****//
					//******************Réquête preparée pour verifier dans la base********************/
		$reqmail = $bdd->prepare('SELECT * FROM membres WHERE courriel = ?');
		$executereqmail = $reqmail->execute(array($mailEnreg));       //Verification doublons
		$emailexist = $reqmail->rowCount();
		if($emailexist == 0){

	  //*****************************-3- insertion dans la base de données**************************************//

		$longueurCle = 11;   // déclaration, longueur de clé 11 caractères, 
		$cle = "";		// et initialisation de key qui servira pour la confirmation par mail
		for($i=1; $i<$longueurCle; $i++)   // Implementation ++.
		$cle .= mt_rand(0,9); 	//  un chiffre de 0 à 9 sera changé dans la clé et mélange à nouveau 

						//******************Réquête preparée pour insertion dans la bdd***************************************/
		$insertionMembre = $bdd->prepare ('INSERT INTO membres (nom, prenom, courriel, codepostal, motDePasse, avatar, confirmkey) VALUES(?, ?, ?, ?, ?, ?, ?)');
		$execution = $insertionMembre->execute(array($nom, $prenom, $mailEnreg, $codePostal ,sha1($pswEnreg), "default.jpg", $cle));


		/***********************Mail , envoi***********************/ 

// formatage d'un courriel avec un lien vers confirmation.php en y envoyant $nom  et $cle. On aurait pu envoyer aussi mail, id …. mais toujours avec $cle (href="http://localhost/films/serveur/confirmation.php?nom='.urlencode($nom).'&cle='.$cle.'")
// Remarque la clé est envoyée dans l'url de confirmation.php


												$header="MIME-Version:1.0\r\n";
												$header.='From:"Dekalossy.com"<support@dekalossy.com>'."\n";
												$header.='Content-Type:text/html; charset="utf-8"'."\n";
												$header.='Content-Transfert-Encoding:8bits';

												$message = '
												<html>
												<body>
												<div align="center"> 
												 <p> Bonjour <b> '.$nom .'</b></p><br/>
												 <a href="http://localhost/fichier/serveur/confirmation.php?nom='.urlencode($nom).'&cle='.$cle.'">Veuillez valider votre inscription à <b>AMT-FILM</b>, <br>en cliquant ici..!</a>
												<br/>
												<img src="http://www.primfix.com/mailing/separation.png"
												</div>
												</body>
												</html>
												';

												mail($mailEnreg, "Confirmation de compte", $message, $header);




				?>
						 	<!-------------- inscrition reussie ----------------->

							<div class="confirmation">  
								<div class="message">
									
									<div class="msgbox">
										<div class="contenu_box">
											<div class="image_ok">
											<span><i class="fa fa-check-circle" aria-hidden="true" style="color: #82ce34"></i></span> 
											</div>
											<div> <h2> FÉLICITATION..! </h2><b><?php echo  $nom; ?></b>
											</div>
											<div> <p>Votre compte été crée. <br/> un courriel a été envoyé à <b><?php echo $mailEnreg; ?></b> 
												 Veuillez confirmer dans vos courriels.</div>
											<button  ><a href="#" data-toggle="modal" data-target="#demoModal">Se connecter</a> </button>
										</div>
									</div>
								</div>
							</div>


						 	<?php

		   }
		   else{

		   		echo "Courriel existant";


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
								<div> <p> Ce courriel  <b><?php echo $mailEnreg; ?></b> existe déjà,<br/>
									 essayez de vous connecter</div>
								<button  ><a href="#" data-toggle="modal" data-target="#demoModal">Se connecter</a> </button>
								
							</div>
						</div>

					</div>
				</div>

			<?php


		   }


}

?>
