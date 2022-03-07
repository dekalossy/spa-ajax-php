<?php
ob_start();
require("bdd.php"); 
include_once("entete.php");



?>
			<div class="top-nav">
				<ul>
					<li class="active1"><a href="membres.php?nom=<?= $_SESSION['nom']."&confirmkey=".$_SESSION['confirmkey'] ; ?>">accueil</a></li>
                    <li><a href="#" onClick="rendreVisible('drame'); rendreInvisible('aventure', 'jeunesse', 'romantique', 'action')">DRAME</a></li>
                    <li><a href="#" onClick="rendreVisible('aventure'); rendreInvisible('drame', 'jeunesse', 'romantique', 'action')">AVENTURE</a></li>	
					<li><a href="#" onClick="rendreVisible('jeunesse'); rendreInvisible('drame', 'aventure', 'romantique', 'action')">JEUNESSE</a></li>
					<li><a href="#" onClick="rendreVisible('romantique'); rendreInvisible('drame', 'aventure', 'action', 'jeunesse')">ROMANTIQUE</a></li>
					<li><a href="#" onClick="rendreVisible('action'); rendreInvisible('romantique', 'jeunesse', 'drame', 'aventure')">ACTION</a></li>			             
					<li><a href="#">SUSPENSE</a></li>	
					<li><a href="#">CONTACT</a></li>					
					<div class="clear"> </div>
				</ul>
			</div>
<?php



if(isset($_GET['nom']) AND isset($_GET['confirmkey'])){


		$getNom = $_GET['nom'];
		$getConfirmkey = $_GET['confirmkey'];




											//VERIFICATION DE L'EXISTENCE DE VARIABLES DE SESSION

		 if(isset($_SESSION['nom']) AND $getNom == $_SESSION['nom']  AND $getConfirmkey == $_SESSION['confirmkey']){


		 	$requser = $bdd->prepare("SELECT * FROM membres WHERE nom = ? AND confirmkey = ?");
  			$requser->execute(array($getNom, $getConfirmkey));
  
 			$user = $requser->fetch();


 			if(isset($_POST['passwordchange'])){     // changement password

				if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND  isset($_POST['newpassword_confirm']) AND !empty($_POST['newpassword_confirm'])){

					$newpassword = sha1($_POST['newpassword']);
      				$newpassword_confirm = sha1($_POST['newpassword_confirm']);

      				if($_POST['newpassword'] == $_POST['newpassword_confirm'])

      					{
      					$changepassword = $bdd->prepare("UPDATE membres SET motDepasse = ? WHERE id = ?");
        				$changepassword->execute(array($newpassword, $_SESSION['id']));
        				

        		//	header("Location:profil.php?id=".$_SESSION['id'].'&pseudo='.$_SESSION['pseudo']);
      				}
      				else
     			 		{
      					$erreur = "Vos mots de passe doivent correspondre!";
      				}


				}



			if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

				$tailleMax = 2097152; /*On definit une taille max et les extensions valides pour sécuriser*/
				$extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
				if ($_FILES['avatar']['size'] <= $tailleMax){


					$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
	 				if (in_array($extensionUpload, $extensionsValides)){

	 					$chemin = "../membres/avatars/".$_SESSION['nom'].".".$extensionUpload;
	 	   				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

	 	   					if ($resultat){

	 	   						$insertAvatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE nom = :nom');
	 	   						$insertAvatar->execute(array(
	 	   		 				'avatar' => $_SESSION['nom'].".".$extensionUpload , 
	 	   		 				'nom' => $_SESSION['nom']));

	 	   					header("Location:membres.php?nom=".$user['nom'].'&confirmkey='.$user['confirmkey']);
	 	    				}
	 	    				else
	 	    					{
	 	    					$erreur = "Erreur durant l'importation de votre photo";
	 	    				}





	 				}
	 				else{
	 					$erreur = "votre photo doit respecter le format jpg, jpeg, gif ou png";
	 				}


				}
				else{
					$erreur = "Votre photo de profil ne doit pas depasser 2Mo";
				}







			}









			}



















			 	echo '<h5 style="color:#fff">EDITION DE PROFIL <br><b>'.$_SESSION['nom'].'</b></h5>';

			 	?>
	             <center> <img class="img_avatar" style="border-radius:100px" src="../membres/avatars/<?php echo "default.jpg";  ?>" width="150" /><br>
	              <!-- j'ai ajouter une class img_avatar à image pour pouvoir l'arrondir dans css-->
	              <div class="btn-danger"><?php if(isset($erreur)){ echo $erreur ;}?></div>
	             <div class="bloc_formulaire">
 				 
    			 <div class='titre'>
      				<i class="fa fa-user-circle-o" aria-hidden="true"></i> <br/>
    			</div> <br />
    			<form action="" method="post" enctype="multipart/form-data">
    				<input type="password" name="newpassword" value="" placeholder="Nouveau mot de passe" /><br /><br />
    				<input type="password" name="newpassword_confirm" value="" placeholder="Confirmation password" /><br /><br />
    				<label for="avatar"   style="color:#fff">Avatar</label>
    				<input type="file" name="avatar"  /><br /><br />
    				<button class="btn_connexion " name="passwordchange">Mettre à jour</button> <br /><br />
    				<button class="btn_connexion"><a href="<?php echo "membres.php?id=".$user['id'].'&confirmkey='.$user['confirmkey'] ?>">Profil</a> </button> <br /><br/>
    

  				</form>
  				</center>
			</div>












	          <?php


			 

		 }
		 else{
		 	header("location: ../index.php");
		 }





	

}
else{
	header("location: ../index.php");
}


ob_end_flush();
?>





<!--***************************************SECTION DRAME******************************************-->

<div id="drame">
	<div class="content">
		<div class="products-box">
			<div class="products">
				<h5><span>D</span>rame</h5>
				<div class="section group">
<!---------------GRID ET MODAL--- ON CREERA UNE FONCTION POUR CETTE SECTION DE CODE-------------------->
					<?php 
					$listeFilms = $bdd->query('SELECT * FROM films WHERE categorie = "drame" ORDER BY dateFilm DESC LIMIT 25');
					while($films = $listeFilms->fetch()){  ?>
						<div class="grid_1_of_5 images_1_of_5">
							<img src="<?php echo '../pochettes/'.$films['pochette']; ?>" title="<?php echo $films['titre'];?>">
							<h3>Synopsis</h3>
							<div class="overflow" >
									 <p><?php echo $films['synopsys']; ?></p>
							</div>

							<div class="button" ><span><a href="#" data-toggle="modal" data-target="#<?php echo 'film'.$films['id'];?>" data-backdrop="false">Voir la bande annonce</a></span></div>
					    </div>

<!------------------------------VIDEO MODAL---------------------------->

	<div class="modal fade "   id="<?php echo 'film'.$films['id'];?>" tabindex="-1" role="dialog"
         aria-labelledby="demoModal" aria-hidden="true" >
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="">
                   <div class="pull-up-lg">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-md-10 mx-auto pb-5 modalCol10">
                                   <div class="bg-light rounded shadow-sm px-3 py-3">
                                   	<h5 ><?php echo $films['titre'];?></h5>

                                   	<embed width="100%" src="https://www.youtube.com/embed/<?php echo $films['url'];?>" allowfullscreen="true" >
                                   		<h4><b>Durée</b>:<?php echo $films['duree'];?></h4>
                                   		<p ><b>Catégorie</b>:<span> <?php echo $films['categorie'];?></span></p>
                                   		<p><b>Réalisateur</b>: <?php echo $films['realisateur'];?></p>
                                   		<h5 style="text-align:center"><b>Prix</b>&nbsp;:&nbsp;<span><?php echo $films['prix'];?></span>&nbsp;$ 

                                   		<a class="addToCart" href="#"> Ajouter <img src="../elementActif/images/cart.png" title="cart" /></a></h5>
                                      
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>



					    <?php

						}

						 ?>
<!--------------- FIN GRID ET MODAL----------------------->
				</div>
			</div>
		</div>
	</div>
</div>






<!--***************************************SECTION AVENTURE******************************************-->


<div id="aventure">
	<div class="content">
		<div class="products-box">
			<div class="products">
				<h5><span>A</span>venture</h5>
				<div class="section group">
<!---------------GRID ET MODAL--- ON CREERA UNE FONCTION POUR CETTE SECTION DE CODE-------------------->
					<?php 
					$listeFilms = $bdd->query('SELECT * FROM films WHERE categorie = "AVENTURE" ORDER BY dateFilm DESC LIMIT 25');
					while($films = $listeFilms->fetch()){  ?>
						<div class="grid_1_of_5 images_1_of_5">
							<img src="<?php echo '../pochettes/'.$films['pochette']; ?>" title="<?php echo $films['titre'];?>">
							<h3>Synopsis</h3>
							<div class="overflow" >
									 <p><?php echo $films['synopsys']; ?></p>
							</div>

							<div class="button" ><span><a href="#" data-toggle="modal" data-target="#<?php echo 'film'.$films['id'];?>" data-backdrop="false">Voir la bande annonce</a></span></div>
					    </div>

<!------------------------------VIDEO MODAL---------------------------->

	<div class="modal fade "   id="<?php echo 'film'.$films['id'];?>" tabindex="-1" role="dialog"
         aria-labelledby="demoModal" aria-hidden="true" >
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="">
                   <div class="pull-up-lg">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-md-10 mx-auto pb-5 modalCol10">
                                   <div class="bg-light rounded shadow-sm px-3 py-3">
                                   	<h5 ><?php echo $films['titre'];?></h5>

                                   	<embed width="100%" src="https://www.youtube.com/embed/<?php echo $films['url'];?>" allowfullscreen="true" >
                                   		<h4><b>Durée</b>:<?php echo $films['duree'];?></h4>
                                   		<p><b>Catégorie</b>: <?php echo $films['categorie'];?></p>
                                   		<p><b>Réalisateur</b>: <?php echo $films['realisateur'];?></p>
                                   		<h5 style="text-align:center"><b>Prix</b>&nbsp;:&nbsp;<span><?php echo $films['prix'];?></span>&nbsp;$ 

                                   		<a class="addToCart" href="#"> Ajouter <img src="../elementActif/images/cart.png" title="cart" /></a></h5>
                                      
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>



					    <?php

						}

						 ?>
<!--------------- FIN GRID ET MODAL----------------------->
				</div>
			</div>
		</div>
	</div>
	
</div>


<!--***************************************SECTION JEUNESSE******************************************-->


<div id="jeunesse">
	<div class="content">
		<div class="products-box">
			<div class="products">
				<h5><span>J</span>eunesse</h5>
				<div class="section group">
<!---------------GRID ET MODAL--- ON CREERA UNE FONCTION POUR CETTE SECTION DE CODE-------------------->
					<?php 
					$listeFilms = $bdd->query('SELECT * FROM films WHERE categorie = "jeunesse" ORDER BY dateFilm DESC LIMIT 25');
					while($films = $listeFilms->fetch()){  ?>
						<div class="grid_1_of_5 images_1_of_5">
							<img src="<?php echo '../pochettes/'.$films['pochette']; ?>" title="<?php echo $films['titre'];?>">
							<h3>Synopsis</h3>
							<div class="overflow" >
									 <p><?php echo $films['synopsys']; ?></p>
							</div>

							<div class="button" ><span><a href="#" data-toggle="modal" data-target="#<?php echo 'film'.$films['id'];?>" data-backdrop="false">Voir la bande annonce</a></span></div>
					    </div>

<!------------------------------VIDEO MODAL---------------------------->

	<div class="modal fade "   id="<?php echo 'film'.$films['id'];?>" tabindex="-1" role="dialog"
         aria-labelledby="demoModal" aria-hidden="true" >
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="">
                   <div class="pull-up-lg">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-md-10 mx-auto pb-5 modalCol10">
                                   <div class="bg-light rounded shadow-sm px-3 py-3">
                                   	<h5 ><?php echo $films['titre'];?></h5>

                                   	<embed width="100%" src="https://www.youtube.com/embed/<?php echo $films['url'];?>" allowfullscreen="true" >
                                   		<h4><b>Durée</b>:<?php echo $films['duree'];?></h4>
                                   		<p><b>Catégorie</b>: <?php echo $films['categorie'];?></p>
                                   		<p><b>Réalisateur</b>: <?php echo $films['realisateur'];?></p>
                                   		<h5 style="text-align:center"><b>Prix</b>&nbsp;:&nbsp;<span><?php echo $films['prix'];?></span>&nbsp;$ 

                                   		<a class="addToCart" href="#" > Ajouter <img src="../elementActif/images/cart.png" title="cart" /></a></h5>
                                      
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>



					    <?php

						}

						 ?>
<!--------------- FIN GRID ET MODAL----------------------->
				</div>
			</div>
		</div>
	</div>
	
</div>




<!--***************************************SECTION ROMANTIQUE******************************************-->


<div id="romantique">
	<div class="content">
		<div class="products-box">
			<div class="products">
				<h5><span>R</span>OMANTIQUE</h5>
				<div class="section group">
<!---------------GRID ET MODAL--- ON CREERA UNE FONCTION POUR CETTE SECTION DE CODE-------------------->
					<?php 
					$listeFilms = $bdd->query('SELECT * FROM films WHERE categorie = "romantique" ORDER BY dateFilm DESC LIMIT 25');
					while($films = $listeFilms->fetch()){  ?>
						<div class="grid_1_of_5 images_1_of_5">
							<img src="<?php echo '../pochettes/'.$films['pochette']; ?>" title="<?php echo $films['titre'];?>">
							<h3>Synopsis</h3>
							<div class="overflow" >
									 <p><?php echo $films['synopsys']; ?></p>
							</div>

							<div class="button" ><span><a href="#" data-toggle="modal" data-target="#<?php echo 'film'.$films['id'];?>" data-backdrop="false">Voir la bande annonce</a></span></div>
					    </div>

<!------------------------------VIDEO MODAL---------------------------->

	<div class="modal fade "   id="<?php echo 'film'.$films['id'];?>" tabindex="-1" role="dialog"
         aria-labelledby="demoModal" aria-hidden="true" >
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="">
                   <div class="pull-up-lg">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-md-10 mx-auto pb-5 modalCol10">
                                   <div class="bg-light rounded shadow-sm px-3 py-3">
                                   	<h5 ><?php echo $films['titre'];?></h5>

                                   	<embed width="100%" src="https://www.youtube.com/embed/<?php echo $films['url'];?>" allowfullscreen="true" >
                                   		<h4><b>Durée</b>:<?php echo $films['duree'];?></h4>
                                   		<p><b>Catégorie</b>: <?php echo $films['categorie'];?></p>
                                   		<p><b>Réalisateur</b>: <?php echo $films['realisateur'];?></p>
                                   		<h5 style="text-align:center"><b>Prix</b>&nbsp;:&nbsp;<span><?php echo $films['prix'];?></span>&nbsp;$ 

                                   		<a class="addToCart" href="#" > Ajouter <img src="../elementActif/images/cart.png" title="cart" /></a></h5>
                                      
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>



					    <?php

						}

						 ?>
<!--------------- FIN GRID ET MODAL----------------------->
				</div>
			</div>
		</div>
	</div>
	
</div>


<!--***************************************SECTION ACTION******************************************-->


<div id="action">
	<div class="content">
		<div class="products-box">
			<div class="products">
				<h5><span>A</span>ction</h5>
				<div class="section group">
<!---------------GRID ET MODAL--- ON CREERA UNE FONCTION POUR CETTE SECTION DE CODE-------------------->
					<?php 
					$listeFilms = $bdd->query('SELECT * FROM films WHERE categorie = "action" ORDER BY dateFilm DESC LIMIT 25');
					while($films = $listeFilms->fetch()){  ?>
						<div class="grid_1_of_5 images_1_of_5">
							<img src="<?php echo '../pochettes/'.$films['pochette']; ?>" title="<?php echo $films['titre'];?>">
							<h3>Synopsis</h3>
							<div class="overflow" >
									 <p><?php echo $films['synopsys']; ?></p>
							</div>

							<div class="button" ><span><a href="#" data-toggle="modal" data-target="#<?php echo 'film'.$films['id'];?>" data-backdrop="false">Voir la bande annonce</a></span></div>
					    </div>

<!------------------------------VIDEO MODAL---------------------------->

	<div class="modal fade "   id="<?php echo 'film'.$films['id'];?>" tabindex="-1" role="dialog"
         aria-labelledby="demoModal" aria-hidden="true" >
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="">
                   <div class="pull-up-lg">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-md-10 mx-auto pb-5 modalCol10">
                                   <div class="bg-light rounded shadow-sm px-3 py-3">
                                   	<h5 ><?php echo $films['titre'];?></h5>

                                   	<embed width="100%" src="https://www.youtube.com/embed/<?php echo $films['url'];?>" allowfullscreen="true" >
                                   		<h4><b>Durée</b>:<?php echo $films['duree'];?></h4>
                                   		<p><b>Catégorie</b>: <?php echo $films['categorie'];?></p>
                                   		<p><b>Réalisateur</b>: <?php echo $films['realisateur'];?></p>
                                   		<h5 style="text-align:center"><b>Prix</b>&nbsp;:&nbsp;<span><?php echo $films['prix'];?></span>&nbsp;$ 

                                   		<a class="addToCart" href="#" > Ajouter <img src="../elementActif/images/cart.png" title="cart" /></a></h5>
                                      
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>



					    <?php

						}

						 ?>
<!--------------- FIN GRID ET MODAL----------------------->
				</div>
			</div>
		</div>
	</div>
	
</div>