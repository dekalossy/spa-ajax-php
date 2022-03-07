<?php
session_start();
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
define('FICHIER', '../donnees/membres.txt');// enregistrement.txt contiendra les Informations enregistrees. la constante FICHIER definie  permet d'appeler le fichier correspondant 

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
else{  // ** 2- Vérification d'abscence de doublons de courriel avant insertion dans enregistrement.txt ou  la base**//
					//******************Réquête preparée pour verifier dans la base se fera ici********************/
		if(!$file=fopen(FICHIER,"r+")){     // On essaie d'acceder à FICHIER pour vérification  --mode r+

				echo "Problème d'enregistrement..!<br><a href='../index.html'>Accueil</a>";
				exit;										// si impossible on arrête tout.
			}

			else{  /****  la recherche de doublons avant insertion***/


				$mailExist=false;
						$ligneFichier=fgets($file);
						while(!feof($file)){
						   $tab=explode(';',$ligneFichier);
							  if($tab[2]==$mailEnreg){
							     $mailExist=true;
							     fclose($file);
						     
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
exit;

						 	}

					   $ligneFichier=fgets($file);		
					  }
					  fclose($file);



			 $file=fopen(FICHIER,"a+");
			 $ligne=$nom.';'.$prenom.';'.$mailEnreg.';'.sha1($pswEnreg).';'.$ville.';'.$province.';'.$codePostal.';Membre ; A'."\n";
			 fputs($file, $ligne);  
			 fclose($file);
			 }
	/*******************************  fin enregistrement dans FICHIER**************************************/

?>	

				<div class="confirmation">  
								<div class="message">
									
									<div class="msgbox">
										<div class="contenu_box">
											<div class="image_ok">
											<span><i class="fa fa-check-circle" aria-hidden="true" style="color: #82ce34"></i></span> 
											</div>
											<div> <h2> FÉLICITATION..! </h2><b><?php echo  $nom; ?></b>
											</div>
											<div> <p>Votre compte été crée. <br/> Essayez de vous connecter avec votre courriel <br><b><?php echo $mailEnreg; ?></b></p></div>
											<button  ><a href="#" data-toggle="modal" data-target="#demoModal">Se connecter</a> </button>
										</div>
									</div>
								</div>
							</div>


<?php
		

	}

?>
			
