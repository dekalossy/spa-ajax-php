//requêtes films  $.ajax({})

function affichageAccueil(){
	var formFilm = new FormData();
	formFilm.append('action','listetousfilms');
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
}







$(document).ready(function(){
	$('#suspense').click(function(){
		var formFilm = new FormData();
		formFilm.append('action','romantique');
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


		$('#enteteCategorie').html('suspense');
		
	})


	
})







$(document).ready(function(){
	$('#suspense').click(function(){
		alert('Bienvenue, Jquery en marche...!');
		$('#exo').css('color', 'red');
		$('p:first').css('background-color', 'blue');
	})


	
})

