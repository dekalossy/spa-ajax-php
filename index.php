

<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Films - SPA Ajax, Php, MySql</title>
		<link href="elementActif/css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<script src="elementActif/js/jquery-1.6.js" type="text/javascript"></script>

		
		<script src="assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="elementActif/js/monJS.js"></script>
		<script type="text/javascript" src="elementActif/js/filmsRequetes.js"></script>
		<script type="text/javascript" src="elementActif/js/vueFilms.js"></script>
		<link rel="stylesheet" href = "elementActif/css/nosCSS.css">
		<link rel="icon" href="elementActif/images/iconSite.png" type="image/png" sizes="16x16">
		<link rel="stylesheet" href = "elementActif/css/bootstrap.css">
		
		<!----------------------------------------------------------->

<!------------------------------------MODAL RESSOURCES here--------------------------------->
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Lunar CSS -->
    <link rel="stylesheet" href="assets/css/lunar.css">
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,600,700,800,900" rel="stylesheet">
    
    
   <!--------------------------------------------------------------------->
	<div id="image"></div>
	
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/lunar.js"></script>
	<script src="assets/js/demo.js"></script>
	<!---------------------------------- FIN RESSOURCES-Modal---------------------------------------->
	<link rel="stylesheet" href = "elementActif/css/nosCSS.css">




	</head>
	<body  onload="chargeSelect(); affichageAccueil();">
		<!---start-wrap--->
		<div class="wrap">
			<!---start-header--->
			<div class="header">
			<!---start-top-header--->
			<div class="top-header">
				<div class="top-header-left">

				<div class="clear"> </div>
			</div>
			<div class="clear"> </div>
			<div class="sub-header">
				<div class="logo">
					<a href="index.php"><img src="elementActif/images/logo-AM.png" title="logo" /></a>
				</div>
				<!---<div class="sub-header-center">
					<form>
						<input type="text"><input type="submit"  value="search" />
					</form>
				</div>--->
				<div class="sub-header-right">

					<ul>
						<li><a href="#" data-toggle="modal" data-target="#nouveauMembreModal">NOUVEAU MEMBRE</a></li>
						<li><a href="#" data-toggle="modal" data-target="#demoModal">MON COMPTE</a></li>
						<li><a href="#">PANIER: (VIDE) <img src="elementActif/images/cart.png" title="cart" /></a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>


			<div class="clear"> </div>
			<div class="top-nav">
				<ul>
					<li class="active1"><a href="index.php">accueil</a></li>
					<li><a onclick="triCategorie('drame');" href="#">DRAME</a></li>
					<li><a onclick="triCategorie('aventure');" href="#">AVENTURE</a></li>	
					<li><a onclick="triCategorie('jeunesse');" href="#">JEUNESSE</a></li>		
					<li><a onclick="triCategorie('romantique');" href="#">ROMANTIQUE</a></li>		
					<li><a onclick="triCategorie('action');" href="#">ACTION</a></li>			     
					<li><a onclick="triCategorie('suspense'); " href="#">SUSPENSE</a></li>	
					<li><a id="gestion" href="#">GESTION</a></li>					 <!------->
					<div class="clear"> </div>
				</ul>
			</div>
			<!---end-top-header--->
			<!---End-header--->
			</div><br />
				<div class="content">
					<div class="content">
						<div class="products-box">
						<div class="products">
							<h5 id="enteteCategorie"><span>LES </span>Nouveautés AJAX</h5>
						<div class="section group" id="contenu">
							
						</div>
						</div>
						</div>
					</div>
				</div>
	

			<div class="clear"> </div>
<!-----------------------------------FOOTER---------------------------------------->
			<div class="footer">
				<div class="wrap">
				<div class="section group">
					<div class="footContent ">
						<ul class="d-flex icones">
							<li><a href="#"><img src="elementActif/images/facebook_1.png" title="facebook" /></a></li>
							<li><a href="#"><img src="elementActif/images/twitter_1.png" title="Twitter" /></a></li>
							<li><a href="#"><img src="elementActif/images/instagram_3.png" title="Instagram" /></a></li>
							<li><a href="#"><img src="elementActif/images/googleplus.png" title="Google+" /></a></li>
							<li><a href="#"><img src="elementActif/images/rss_61.png" title="Rss" /></a></li>
						</ul>
						<p style="text-align: center;">&copy; 2020 TAMfilm | Par <span>Taliby Fofana </span></p>
					</div>
				</div>
				</div>
			</div>
<!----------------------------------- FIN FOOTER---------------------------------------->
		</div>
		<!---End-wrap--->



























<!-----------------------------------Modal- mon compte- CONNEXION--------------------------------------->

    <!-- Modal -->
    <div class="modal fade "   id="demoModal"  tabindex="-1" role="dialog"
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
                                       <h2 class="pt-sm-3  text-center">Connexion</h2>
                                       <p class="text-muted">
                                           Veuillez saisir vos informations de compte
                                       </p>
                                       <form  id="formConnect" action="serveur/connexion.php" method="POST" onsubmit="return validation_connect();">
                                       	<div  class="erreur" id="alert1" ></div>
                                           
                                           <div class="form-group">
                                               <label for="emailConnect" >Entrez votre courriel</label>
                                               <input type="email" class="form-control" id="emailConnect" name="emailConnect" aria-describedby="emailHelp" placeholder="">
                                               <small id="emailHelp" class="form-text text-muted">Votre courriel ne sera jamais partagé</small>
                                           </div>

                                           <div class="form-group">
                                               <label for="pswdConnect">Entrez votre mot de passe</label>
                                               <input type="password" class="form-control"  name="pswdConnect" id="pswdConnect" aria-describedby="emailHelp" placeholder="">
                                           </div>
                                           <a href="#">Mot de passe oublié?</a>

                                           <button type="submit" class="btn  btn-block btn-cta" name="submitConnect" >Connexion</button>
                                       </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    

 <!----------------------------------- FIN Modal---------------------------------------->


<!-- Small modal pour Confirmation enregistrement de film-->
<div class="modal" tabindex="-1" id="">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color:#f6881fad">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><b>Film enregistré avec succès..!</b></p>
      </div>
     
    </div>
  </div>
</div>



<!-- Small modal pour film-->
<div class="modal " tabindex="-1" id="confModalFilm" >
  <div class="modal-dialog ">
    <div class="modal-content" style="background-color:#2196f3">
      <div class="modal-header">
        <h5 class="modal-title" style="color:white"><b>Confirmation</h5>
      </div>
      <div class="modal-body">
        <p id="confText"><b>....</b></p>
        <p><b>Film enregistré avec succès..!</b></p>
        
        <input type="hidden" id="filmId" value="">
      </div>
     
    </div>
  </div>
</div>











 <!-----------------------------------Modal- Nouveau membre-- INSCRIPTION------------------------------------->

    <!-- Modal -->
    <div class="modal fade "   id="nouveauMembreModal"  tabindex="-1" role="dialog"
         aria-labelledby="demoModal" aria-hidden="true" >
        <div class="modal-dialog  modal-dialog-centered " role="document">
            <div class="modal-content"><br><br>
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="">
                   
                   <div class="pull-up-lg">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-md-12 mx-auto pb-3 modalCol12" >
                                   <div class="bg-light rounded shadow-sm px-3 py-3">
                                       <h2 class="pt-sm-3  text-center">Devenir membre</h2>
                                       <p class="text-muted">
                                           Veuillez saisir vos informations d'inscription
                                       </p>
                                       <form  id="formEnreg" action="serveur/enregistrementMembre.php" method="POST" onsubmit="return validation();">

											

                                       	 <div class="form-row d-flex">
				  		  					<div class="form-group col-12 col-md-6">
												<label for="prenom">Prénom :</label>
												<input type="text" class="form-control" name="prenom" id="prenom" />
						  					</div>
						  					<div class="form-group  col-12 col-md-6">
											<label for="nom">Nom :</label>
											<input type="text" class="form-control" name="nom" id="nom" />
						  					</div>	  
				  						 </div>
                                           
                                           <div class="form-group">
                                               <label for="mailEnreg" >Courriel</label>
                                               <input type="email" class="form-control" id="mailEnreg" aria-describedby="emailHelp" name="mailEnreg">
                                               <small id="emailHelp" class="form-text text-muted">Votre courriel ne sera jamais partagé</small>
                                           </div>
                                           <div class="form-group">
				    							<label for="adresse">Adresse</label>
				    							<input type="text" class="form-control" id="adresse"  placeholder=" " name="adresse">
				  							</div>

<!------------------------------------------------------------------------------------------------------>

<div class="form-row">
				    <div class="form-group col-md-4">
				      <label for="ville">Ville :</label>
					  <input type="text" class="form-control"  id="ville"  name="ville"/>
				    </div>
				    <div class="form-group col-md-5">
				      <label for="selectProvince">Province :</label>
				      <select name="selectProvince" id="selectProvince" class="form-control">
				        	
				      </select>
				      <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
				    </div>
				    <div class="form-group col-md-3">
				      <label for="codePostal">Code postal</label>
				      <input type="text"  id="codePostal" name="codePostal" class="form-control">
				    </div>
				  </div>





	<!----------------------------------------------------------------------------------------------->
                                        <!------------------- radio date de naissance---------------------->
											<div class="form-row justify-content-between">

											  <div class="form-group col-md-6">
												<input type="date" class="form-control" name="dateNaissance" id="dateNaissance"  min="1900-01-01" max="2002-12-31">
												<small class="form-text text-muted ">Date de naissance</small>
											  </div>
											  <div class="form-radio col-md-6">
													<label for="genre" class="radio-label">Sexe:</label>
														<input type="radio" name="genre" value="homme" checked>
														<label for="homme">Homme</label>
														<span class="check"></span>
													
													
														<input type="radio" name="genre" value="femme">
														<label for="femme">Femme</label>
														<span class="check"></span>
												
											  </div>

											</div>   



										<div class="form-row justify-content-between">
                                           <div class="form-group col-md-6">
											    <label for="pswEnreg">Mot de passe</label>
												<input type="password" class="form-control" id="pswEnreg"  name="pswEnreg"  placeholder="">
												<small class="form-text text-muted ">8 à 20 caractères</small>
											</div>

											<div class="form-group col-md-6">
											    <label for="pswEnregConfirm">Confirmation mot de passe</label>
											    <input type="password" class="form-control" id="pswEnregConfirm" name="pswEnregConfirm" placeholder="">
											</div>
										</div>

										<div class="form-group form-check">
										    <input type="checkbox" class="form-check-input" id="exampleCheck1" >
										    <label class="form-check-label" for="exampleCheck1">J'accepte les conditions d'utilisation</label>
										</div>
										<div  class="erreur" id="alert" ></div>

                                        <div class="d-flex justify-content-between">
											<input type="reset" value="Effacer" class="submit" name="reset" id="reset" onclick="effacerFormulaire()"/>
											<input type="submit" value="Envoyez" class="submit" name="submit" id="submit"   />
										</div>




                                       </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    

 <!----------------------------------- FIN Modal---------------------------------------->
<script>
   $('.top-nav li').click(function(){
        $('.top-nav li').removeClass('active1');
        $(this).addClass('active1');
    }) 
</script>



	</body>
</html>

