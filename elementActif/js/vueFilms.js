


function filmsVue(listFilms){

	rep = "";
	
	for(film of listFilms){
	rep += 	cardTemplate(film);
	}
	
	$('#contenu').html(rep);

	
}	




		let cardTemplate = (film)=> {
    
				return `
								
						<div class="grid_1_of_5 images_1_of_5">
							<img src="pochettes/${film.pochette}" title="${film.titre}">
							<h3>Synopsys</h3>
							<div class="overflow" >
									 <p>${film.synopsys}</p>
							</div>

							<div class="button" ><span><a href="#" data-toggle="modal" data-target="#film${film.id}" data-backdrop="false">Voir la bande annonce</a></span></div>

					    </div>


			 <!------------------------------VIDEO MODAL---------------------------->

    <div class="modal fade filmmod"   id="film${film.id}" tabindex="-1" role="dialog"
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
                                   	<h5 >${film.titre}</h5>

                                   	<embed width="100%" src="https://www.youtube.com/embed/${film.url}" style="allowfullscreen:true" >
                                   		<h4><b>Durée</b>:${film.duree}</h4>
                                   		<p><b>Catégorie</b>: ${film.categorie}</p>
                                   		<p><b>Réalisateur</b>: ${film.realisateur}</p>
                                   		<h5 style="text-align:center"><b>Prix</b>: ${film.prix} $ 

                                   		<a href="#"> Ajouter <img src="elementActif/images/cart.png" title="cart" /></a></h5>
                                      
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>

 <!------------------------------>


                       `

                 }
        
        

function tableFilm(listFilms){
    
    rep = "";
    for(film of listFilms){
        rep +=  tableauFilm(film);
    }
    
    $('.tablefilms td').parent().remove(); //supprime tous les tr avec enfant td donc garde le thead
    $('.tablefilms').append(rep);
    
}


let tableauFilm = (film)=> {
   
    return `
            <tr> 
                <td>${film.id}</td>
                <td>${film.titre}</td>
                <td>${film.categorie}</td>
                <td>${film.duree}</td>
            </tr>
                          
            `
}





function membresVue(listeMembres){
    
    rep = "";
    for(membre of listeMembres){
        rep +=  tableauMembre(membre);
    }
    
     $('.tablemembre td').parent().remove(); //supprime tous les tr avec enfant td donc garde le thead
    $('.tablemembre').append(rep);
    
}


let tableauMembre = (membre)=> {
   
    return `
                <tr> 
                <td>${membre.nom}</td>
                <td>${membre.courriel}</td>
                <td>${membre.confirme}</td>
                <td>xxx</td>
                </tr>
            `
}





let gestionTemplate = ()=> {
    
        return `

                <div class="container">
                      <div class="row">
                      <!--------------GESTION MEMBRES---------->        
                        <div class=" col-md-12 col-lg-6 d-flex boxGestionMembres">
                        <h4>GESTION MEMBRES</h4>
                            <div class="row d-flex justify-content-center">
                                <input type="button" class="lister" value="LISTER" onClick="rendreVisible('listeMembres'); listerMembres() ">
                            </div>

                          <div id="listeMembres" class="formFilms">
                          <span class="close light" onClick="rendreInvisible2('listeMembres')">X</span><br>
                    
                              <table class="table  table-striped table-dark tablemembre">
                                <thead>
                                  <tr class="table-active">
                                    <th><b>NOM</b></th>
                                    <th><b>COURRIEL</b></th>
                                    <th><b>CONFIRME</b></th>
                                    <th><b>ACTION</b></th>
                                  </tr>
                                </thead>
                              <tbody>
                            <!--------------boucle---------------->
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

                                <input type="button"  class="modificationFilms" value="LISTER" onClick="rendreVisible('listerFilms'); rendreInvisible('enregFilms', 'supFilms', 'modiFilms'); affichageAccueil('listeMembres')">
                            </div>
                  <!-------------------------------------FORM ENREGISTREMENT-------------------->

                            <div id="enregFilms">
                                <form id="formEnregFilms" class="formFilms">
                
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
                                          <option >SUSPENSE</option>
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
                                        <input type="file" name="pochette" required>
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
                                    <input type="hidden" name="action" value="enregistrer">
                                  </div>
                                  </div>


                                  <input  type="button" value="Enregistrer" onClick="enregistrerFilm();" ><br>
                    
                              </form>
                          </div><!-----------------------------fin FORM ENREGISTREMENT-------------------->


                            <!---------------------FORM DE SUPPRESSION--------------------------------->

                          <div id="supFilms">
                            <form id="formSup" class="formFilms" action="" method="POST" >
                
                              <span  class="close light" onClick="rendreInvisible('supFilms')">X</span><br>


                             <div class="form-row d-flex " >
                                  <div class="form-group col-12 col-md-6 ">
                                <label for="titreSup">Titre  à supprimer :</label>
                                <select name="titreSup" id="titreSup" >

                                  <!--------------boucle---------------->
                            
                                  <option value="titrefilm" >
                                   ${film.categorie}-${film.titre}
                                  </option>
                         

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

                    <table class="table  table-striped table-dark tablefilms">
                      <thead>
                          <tr class="table-active">
                            <th><b>ID</b></th>
                            <th><b>TITRE</b></th>
                            <th><b>CATEGORIES</b></th>
                            <th><b>DURÉE</b></th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          
                          <!--------------template---------------->
    
                          
                        </tbody>
                     </table>
                    
                  </div>














                        </div><!--------------fin boxGestionFilms----------->









                    </div><!--------------fin row-------------------->
                </div><!--------------fin container-------------------->


                `

}
	



