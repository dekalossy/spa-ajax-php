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
		$getConfirmkey = intval($_GET['confirmkey']); //securise la variable en la convertissant en nombre si besoin

											//VERIFICATION DE L'EXISTENCE DE VARIABLES DE SESSION

		 if(isset($_SESSION['nom']) AND $getNom == $_SESSION['nom']  AND $getConfirmkey == $_SESSION['confirmkey']){

                $requser = $bdd->prepare('SELECT * FROM membres WHERE confirmkey = ?');
 				$requser->execute(array($getConfirmkey)); // on execute avec le id securisé.
 				$userinfo = $requser->fetch(); // on stocke les info recuperées dans $userinfo.


			 	echo '<p style="color:#fff">Bienvenue dans votre espace <br><b>'.$_SESSION['nom'].'</b></p>';

			 	?>
	             <center> <img class="img_avatar" style="border-radius:100px" src="
	             	../membres/avatars/<?php echo  $userinfo['avatar'];  ?>" width="150" />
	             	<a href="<?php echo "editionprofil.php?nom=".$_SESSION['nom'].'&confirmkey='.$_SESSION['confirmkey']; ?>" > Édition profil</a>
	             </center> <!-- j'ai ajouter une class img_avatar à image pour pouvoir l'arrondir dans css-->
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