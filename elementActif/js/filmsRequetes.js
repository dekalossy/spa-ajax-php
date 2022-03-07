
// ***************AFFICHAGE ACCUEIL***************************
function affichageAccueil(precision) { // paramètre facultatif nous permettra de reutiliser la fct
        var formFilm = new FormData();
        formFilm.append('action', 'listetousfilms');
        $.ajax({
            type : 'POST',
            url : '../../serveur/controleurFilms.php',
            data: formFilm,
            contentType : false,
            processData : false,
            dataType : 'json', //text pour le voir en format de string
            success : function (reponse, status) {//console.log(reponse);
                                                  
                        if( typeof(precision) == 'undefined' ){
                           filmsVue(reponse);
                        }else{
                            console.log(reponse);
                            tableFilm(reponse);
                        }
                                                  
            },


            fail : function (err){
            }
        });
       
    
}


// ***************AFFICHAGE AFFICHAGE PAR CATEGORIE***************

function triCategorie(elem) {   

$(document).ready(function() {
	
		var formFilm = new FormData();
		formFilm.append('action',elem);
		$.ajax({
		type : 'POST',
		url : '../../serveur/controleurFilms.php',
		data:formFilm,
		contentType : false,
		processData : false,
		dataType : 'json', //text pour le voir en format de string
		success : function (reponse, status){//console.log(reponse);
					filmsVue(reponse);

		},

		fail : function (err){
		}
	});

		$('#enteteCategorie').html(elem);
		
	})


}



// ***************AFFICHAGE PAGE ADMINISTRATION**************************

$(document).ready(function(){
	$('#gestion').click(function(){
	$('#enteteCategorie').html("ADMINISTRATION");
        
	x = gestionTemplate();
	$('#contenu').html(x);	
		
	})

})


function listerMembres() {
    
    $(document).ready(function(){
        var formFilm = new FormData();
        formFilm.append('action', 'listetousmembres');
        $.ajax({
            type : 'POST',
            url : '../../serveur/controleurFilms.php',
            data: formFilm,
            contentType : false,
            processData : false,
            dataType : 'json', //text pour le voir en format de string
            success : function (reponse, status) {//console.log(reponse);
                membresVue(reponse);
            },

            fail : function (err){
                
            }
        });
        
    })
    	
} 





	
		



//*********************ENREGISTREMENT FILMS*************************

	function enregistrerFilm(){
		$(document).ready(function(){
		formulaire = document.getElementById('formEnregFilms');
		formulaire.submit(function(e) {e.preventDefault();});
		var formFilm = new FormData(formulaire);
		$.ajax({
			type : 'POST',
			url : '../../serveur/controleurFilms.php',
			data : formFilm, //$('#formEnregFilms').serialize();
			dataType : 'json', 
			contentType : false,
			processData : false,
			success : function (reponse){console.log(reponse.message);
						//filmsVue(reponse);  ecrire ici une fonction avec un timeout pour message de retour
						$('#confModalFilm').modal('show');
					    setTimeout(function(){ $('#confModalFilm').modal('hide'); }, 3000);
			},
			fail : function (err){
		   
			}
		});

		})

	} 





$(document).ready(function(){
	$('#suspense').click(function(){
		alert('Bienvenue, Jquery en marche...!');
		$('#exo').css('color', 'red');
		$('p:first').css('background-color', 'blue');
	})
	
})

