<?php
ob_start();
require("bdd.php");
include_once("entete.php");

if(isset($_GET['confirmkey']) AND $_GET['confirmkey'] > 0  AND isset($_GET['nom'])){   // ETAPE 1


		$getconfirmekey = intval($_GET['confirmkey']);
		$requser=$bdd->prepare('SELECT * FROM membres WHERE confirmkey = ?' );
		$requser->execute(array($getconfirmekey));
		$admin=$requser->fetch();							//stockage dans $admin

										// 1- VERIFICATION DE L'EXISTENCE DE VARIABLES DE SESSION

		 if(isset($_SESSION['confirmkey']) AND $admin['confirmkey'] == $_SESSION['confirmkey']){  // ETAPE 2



		 								// REQUETE POUR LISTER TOUS LES MEMBRES PAR ORDRE ALPHABETIQUE
		 $listeMembres = $bdd->query('SELECT * FROM membres ORDER BY nom');
		 								// REQUETE POUR LISTER TOUS LES FILMS
		 $listeFilms = $bdd->query('SELECT * FROM films ORDER BY categorie');


		 /**************************************************************************/

		 					// AJOUT DE FILMS

		  if(isset($_POST['newFilmEnreg'])){
		  	$titreFilm = $_POST['titreFilm'];
		  	$categFilm = $_POST['categFilm'];
		  	$realisateurFilm = $_POST['realisateurFilm'];
		  	$dureeFilm = $_POST['dureeFilm'];
		  	$pochette = $_FILES['pochette']['name'];
		  	$dateFilm = $_POST['dateFilm'];
		  	$url = $_POST['url'];
		  	$synopsys = $_POST['synopsys'];
		  	$prix = $_POST['prix'];

		  	$enregistrementFilms = $bdd->prepare('INSERT INTO films (categorie, titre, realisateur, duree, dateFilm, pochette, url, synopsys, prix) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
		  	$enreg = $enregistrementFilms->execute(array($categFilm, $titreFilm, $realisateurFilm, $dureeFilm, $dateFilm, $pochette, $url, $synopsys, $prix));
		  	move_uploaded_file($_FILES['pochette']['tmp_name'], '../pochettes/'.$pochette);

		  	$msgenregFilms = "Enregistrement fait avec succès..!";



		  }		   	
		  	/**************************************************************************/
							// SUPPRESSION  FILMS

		 if(isset($_POST['supSubmit'])){
		 	$titreSup = $_POST['titreSup'];
		 	$supprimeFilm = $bdd->prepare('DELETE FROM films WHERE titre = ?');
		    $supprimeFilm->execute(array($titreSup));

		    $msgSupFilms = "Film supprimé avec succès..!";
		    

		 }

		/**************************************************************************/
							// MODIFICATION INFOS FILMS






		 	echo '<p style="color:#fff"> Bienvenue '.$admin['courriel'].'</p><br>'

		 	?>
		 	      <div class="container">
  						<div class="row">

				<!--------------GESTION MEMBRES---------->				
						   <div class=" col-md-12 col-lg-6 d-flex boxGestionMembres">
						   	  <h4>GESTION MEMBRES</h4>
						   	  <div class="row d-flex justify-content-center">
						   	    <input type="button" class="lister" value="LISTER" onClick="rendreVisible('listeMembres');">
						      </div>
						   	  <div id="listeMembres" class="formFilms">
						   	  	<span class="close light" onClick="rendreInvisible('listeMembres')">X</span><br>
						        

							   	  	        <table class="table  table-striped table-dark">
											<thead>
											    <tr class="table-active">
											      <th><b>NOM</b></th>
											      <th><b>COURRIEL</b></th>
											      <th><b>ACTION</b></th>
											    </tr>
										    </thead>
										    <tbody>
										    	
										    	<?php while($membre = $listeMembres->fetch()){ ?>
    
											    <tr> 
											    	<td><?php echo $membre['nom']; ?></td>
											    	<td><?php echo $membre['courriel']; ?></td>
											    	<td><?php if($membre['confirme'] == 0){
							   	  	      ?><a href="gestionMembres.php?nom=<?= $membre['nom']."&supprimer=".$membre['confirmkey'] ?> ">Supprimer</a> 
							   	  	        <a href="gestionMembres.php?nom=<?= $membre['nom']."&activer=".$membre['confirmkey'] ?> ">Activer</a><?php 
							   	  	      }else{

							   	  	      ?><a href="gestionMembres.php?nom=<?= $membre['nom']."&supprimer=".$membre['confirmkey'] ?> ">Supprimer</a> 
							   	  	        <a href="gestionMembres.php?nom=<?= $membre['nom']."&desactiver=".$membre['confirmkey'] ?>">Désactiver</a></td>
											    
							   	  	      <?php


							   	  	}?>
   
							   	</tr>

											    <?php

												} ?>

										    </tbody>
									   </table>

							   
						  	  </div>



						   	   
				

						   </div>



				<!-------------- BOUTONS DE GESTION FILMS---------->		   
						   <div class=" col-md-12 col-lg-6 d-flex boxGestionFilms" >
						   	<h4>GESTION FILMS</h4>
						   	<div class="row d-flex justify-content-between">
							   	<input type="button"  class="enregistrementFilms" value="ENREGISTRER" onClick="rendreVisible('enregFilms'); rendreInvisible('supFilms', 'modiFilms', 'listerFilms');">
							   	<input type="button" class="supressionFilms" value="SUPPRIMER" onClick="rendreVisible('supFilms'); rendreInvisible('enregFilms', 'modiFilms', 'listerFilms');">
							   	<input type="button"  class="modificationFilms" value="MODIFIER" onClick="rendreVisible('modiFilms'); rendreInvisible('enregFilms', 'supFilms', 'listerFilms');">
							   	<input type="button"  class="modificationFilms" value="LISTER" onClick="rendreVisible('listerFilms'); rendreInvisible('enregFilms', 'supFilms', 'modiFilms');">

							 </div>
			<!-------------------------------------FORM ENREGISTREMENT-------------------->
							   		<div id="enregFilms">
										<form id="formEnregFilms" class="formFilms" action="" method="POST"   enctype="multipart/form-data">
								
											<span  class="close light" onClick="rendreInvisible('enregFilms')">X</span><br>
											<div> <?php if(isset($msgenregFilms)){echo $msgenregFilms;}?></div>


											<div class="form-row d-flex">
					  		  					<div class="form-group col-12 col-md-6">
													<label for="titreFilm">Titre :</label>
													<input type="text" class="form-control" name="titreFilm" id="titreFilm" required>
							  					</div>
							  					<div class="form-group  col-12 col-md-6">
												<label for="categFilm">Catégorie :</label>
												<select class="form-control" name="categFilm" id="categFilm" required>
														<option >Choisir catégorie...</option>
														<option >DRAME</option>
														<option >ROMANTIQUE</option>
														<option >ACTION</option>
														<option >SUSPENS</option>
												</select>
							  					</div>	  
					  						 </div>

					  						 <div class="form-row d-flex">
					  		  					<div class="form-group col-12 col-md-6">
													<label for="realisateurFilm">Réalisateur:</label>
													<input type="text" class="form-control" name="realisateurFilm" id="realisateurFilm">
							  					</div>
							  					<div class="form-group  col-12 col-md-6">
												<label for="dureeFilm">Durée :</label>
												<input type="text" class="form-control" name="dureeFilm" id="dureeFilm">
							  					</div>	  
					  						 </div>

					  						 <div class="form-row d-flex">
					  		  					<div class="form-group col-12 col-md-6">
												<label for="pochette">Pochette :</label>
												<input type="file" name="pochette">
							  					</div>
							  					<div class="form-group  col-12 col-md-6">
												<label for="dateFilm">Date :</label>
												<input type="date" class="form-control" name="dateFilm" id="dateFilm" min="1900-01-01" max="2020-12-31">
							  					</div>	  
					  						 </div>

					  						 <div class="form-row d-flex">
					  		  					<div class="form-group col-12 col-md-6">
													<label for="synopsys">Synopsys</label>
													<textarea class="form-control" name="synopsys" id="synopsys"></textarea>
												</div>
												<div class="form-group col-12 col-md-6">
												<label for="url">URL :</label>
												<input type="text" name="url" class="form-control" required>



												<label for="prix">Prix :</label>
												<input type="text" name="prix" class="form-control" required>
							  					</div>

					  						 </div>


											<input type="submit" value="Enregistrer" name="newFilmEnreg"><br>
										
										</form>

									</div>


		<!---------------------------FORM DE SUPPRESSION------------------------------------------------------------------>
									


							   		<div id="supFilms">
										<form id="formSup" class="formFilms" action="" method="POST" >
								
											<span  class="close light" onClick="rendreInvisible('supFilms')">X</span><br>


											<div class="form-row d-flex " >
					  		  					<div class="form-group col-12 col-md-6 ">
													<label for="titreSup">Titre  à supprimer :</label>
													<select name="titreSup" id="titreSup" >

														<?php while($films = $listeFilms->fetch()){  ?>
														
														<option value="<?= $films['titre'] ; ?>" >
															<?php echo $films['categorie']." - ".$films['titre'] ; ?>
														</option>


														<?php

														} ?>

							  						</select>
							  					</div>
							  					
							  					<div class="form-group  col-12 col-md-6">
													<input type="submit" class="supressionFilms" value="Supprimer" name="supSubmit"><br>
							  					</div>	  
					  						 </div>

										</form>
									</div>

	<!----------------------------FORM MODIFICATION------------------------------------------------------------>
										


							   		<div id="modiFilms">
										<form id="formModif" class="formFilms" action="" method="POST" >
								
											<span  class="close light" onClick="rendreInvisible('modiFilms')">X</span><br>
									</form>
								    </div>


			<!---------------------------- FORM LISTER --------------------------------->

									<div id="listerFilms" class="formFilms">

										<table class="table  table-striped table-dark">
											<thead>
											    <tr class="table-active">
											      <th><b>ID</b></th>
											      <th><b>TITRE</b></th>
											      <th><b>CATEGORIES</b></th>
											      <th><b>DURÉE</b></th>
											    </tr>
										    </thead>
										    <tbody>
										    	
										    	<?php
										    	$listeFilms = $bdd->query('SELECT * FROM films ORDER BY categorie');
										    	 while($films2 = $listeFilms->fetch()){  ?>
    
											    <tr> 
											    	<td><?php echo $films2['id']; ?></td>
											    	<td><?php echo $films2['titre']; ?></td>
											    	<td><?php echo $films2['categorie']; ?></td>
											    	<td><?php echo $films2['duree']; ?></td>
											    </tr>

											    <?php

												} ?>

										    </tbody>
									   </table>
										
									</div>




			<!--//****************************************--->

		


<!----------------------------------------------------------------------------------------------------------------------->

						   </div>


						</div>
				  </div>




		 	<?php

		 	/*echo'<br><button type="button" class="btn  btn-block btn-cta"><a href="deconnexion.php">Me déconnecter</a></button>'; */




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








 <!-----------------------------------FOOTER---------------------------------------->
			<div class="footer">
				<div class="wrap">
				<div class="section group">
					<div class="footContent ">
						<ul class="d-flex icones">
							<li><a href="#"><img src="../elementActif/images/facebook_1.png" title="facebook" /></a></li>
							<li><a href="#"><img src="../elementActif/images/twitter_1.png" title="Twitter" /></a></li>
							<li><a href="#"><img src="../elementActif/images/instagram_3.png" title="Instagram" /></a></li>
							<li><a href="#"><img src="../elementActif/images/googleplus.png" title="Google+" /></a></li>
							<li><a href="#"><img src="../elementActif/images/rss_61.png" title="Rss" /></a></li>
						</ul>
						<p style="text-align: center;">&copy; 2020 Musicstore. All Rights Reserved | Design by <span>Annie Barbeau - Mohammed Zizi - Fofana Taliby</span></p>
					</div>
				</div>
				</div>
			</div>
<!----------------------------------- FIN FOOTER---------------------------------------->