<?php
ob_start();
require("bdd.php");
include_once("entete.php");

// REQUETE POUR LISTER TOUS LES FILMS
$listeFilms = $bdd->query('SELECT * FROM films WHERE categorie = "aventure" ORDER BY dateFilm DESC LIMIT 25');
	

?>

<!DOCTYPE HTML>
<html lang="fr">
<head></head>
<body>
		<!---start-wrap--->

			<div class="top-nav">
				<ul>
					<li><a href="../index.php">accueil</a></li>
                    <li><a href="drame.php">DRAME</a></li>
                    <li class="active1"><a href="#">AVENTURE</a></li>	
					<li><a href="jeunesse.php">JEUNESSE</a></li>
					<li><a href="romantique.php">ROMANTIQUE</a></li>				
					<li><a href="action.php">ACTION</a></li>			             
					<li><a href="suspense.php">SUSPENSE</a></li>	
					<li><a href="#">CONTACT</a></li>					 
					<div class="clear"> </div>
				</ul>
			</div>
			<!---end-top-header--->
			<!---End-header--->
			<br />
<!--*********************************************************************************-->


<div class="content">
					<div class="products-box">
					<div class="products">
						<h5><span>A</span>VENTURE</h5>
					<div class="section group">

						<?php while($films = $listeFilms->fetch()){  ?>
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
                                   		<h5 style="text-align:center"><b>Prix</b>&nbsp;:&nbsp;<?php echo $films['prix'];?>&nbsp;$ 

                                   		<a href="#"> Ajouter <img src="../elementActif/images/cart.png" title="cart" /></a></h5>
                                      
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

						ob_end_flush();
						 ?>
 <!------------------------------>




<!--*********************************************************************************-->		

		<div class="clear"> </div>
</div>
</div>
</div>
		<!---End-wrap--->


	</body>
</html>

