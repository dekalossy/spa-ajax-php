function myFunction()
{   var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more"; 
      moreText.style.display = "none";
    }
    else
    { dots.style.display = "none";
      btnText.innerHTML = "Read less"; 
      moreText.style.display = "inline";
    }
}



/**********************************VALIDATION DE FORMULAIRE*****************************************/

// definition des RegEx qui serviront à tester la conformité des entrées (à la 2e etape)

var RegExpNom=/^[a-zA-Z]+(?:['-\s][a-zA-Z]+)*$/;
var RegExpPrenom=/^[a-zA-Z]{3,10}(?:['-\s][a-zA-Z]+)*$/; 
var RegExpMail=/^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;
var RegExpSexe=/^[1-2]$/;
var RegExAdresse=/[A-Za-z\d#_!-]{2,100}$/;
var RegExpComment=/^[A-Za-z\d#_!-]{2,200}$/;          //au moins 2 caracteres
var RegExpCodePostal=/^[A-Za-z][0-9][A-Za-z] ?[0-9][A-Za-z][0-9]$/;
var RegExpMotPasse=/^[A-Za-z\d#_!-]{8,20}$/;             // au moins 8 au plus 20
//********************************************************************************


  let province, tabProvince=['Alberta', 'Colombie-Britannique', 'Île-du-Prince-Édouard',
                'Manitoba', 'Nouveau-Brunswick', 'Nouvelle-Écosse', 'Ontario', 'Québec',
                'Terre-Neuve-et-Labrador', 'Nunavut', 'Territoires du Nord-Ouest', 'Yukon'];


function chargeSelect(){

   var selectProvince=document.getElementById('selectProvince');

  for(province of tabProvince)
    selectProvince.options[selectProvince.options.length]=new Option(province);

}


function validation(){

  var msgErreur;
  var alert=document.getElementById('alert');
  var prenom=document.getElementById('prenom').value;
  var nom=document.getElementById('nom').value;
  var mailEnreg=document.getElementById('mailEnreg').value;
  var pswEnreg=document.getElementById('pswEnreg').value;
  var pswEnregConfirm=document.getElementById('pswEnregConfirm').value;
  var dateNaissance=document.getElementById('dateNaissance');
  var adresse=document.getElementById('adresse').value;
  var ville=document.getElementById('ville').value;
  var codePostal=document.getElementById('codePostal').value;
  alert.innerHTML='';

  var selectProvince=document.getElementById('selectProvince');
  var indexOption=selectProvince.selectedIndex;   //  récupération de l'index de l'option choisie
  var province=selectProvince.options[indexOption].text;
  var etatForm=true;

  /****************-1- Vérification du remplissage ce tous les champs****************/

      if (nom=='' || prenom=='' || mailEnreg=='' || pswEnreg=='' || pswEnregConfirm=='' ||  dateNaissance=='' || adresse=='' || ville=='' || codePostal=='' || province==''){
       
        alert.innerHTML= 'Veuillez remplir tous les champs!';
        alert.style.backgoundcolor='red';
        etatForm=false;
      }
      else{  
                 //- 2- verifier la validité, la conformité aux Regex, pour empêcher surtout les injections

          if(!RegExpNom.test(nom)){            //   test validité du nom
               alert.innerHTML+='Format de nom invalide !<br>';
               etatForm=false;
              }


          if(!RegExpPrenom.test(prenom)){            //   test validité du prénom
               alert.innerHTML+='Format de prénom invalide !<br>';
               etatForm=false;
              }

          if(!RegExpMail.test(mailEnreg)){            //   test validité du mail
               alert.innerHTML+='Format de courriel non valide !<br>';
               etatForm=false;
              }

          if(!RegExpMotPasse.test(pswEnreg) || !RegExpMotPasse.test(pswEnregConfirm)){       //   test validité du Pswd
                   alert.innerHTML+='Le mot de passe doit contenir entre 8 et 20 caractères !<br>';
                   etatForm=false;
                  }


           if(!RegExAdresse.test(adresse)){            //   test validité  adresse
                   alert.innerHTML+='Adresse non valide !<br>';
                   etatForm=false;
                  }


          if(!RegExpPrenom.test(ville)){            //   test validité nom de ville, même RegExp que prénom
                   alert.innerHTML+='Nom de ville non valide !<br>';
                   etatForm=false;
                  }

          if(!RegExpCodePostal.test(codePostal)){            //   test validité code postal
                   alert.innerHTML+='Code postal non valide !<br>';
                   etatForm=false;
                  }

          if(pswEnreg!=pswEnregConfirm){          // test de mots de passe identiques
            alert.innerHTML+='Les mots de passe ne sont pas identiques, veuillez réessayer!<br>';
            etatForm=false;
          }

      }


      return etatForm;

  
}


function validation_connect(){

  var alert1=document.getElementById('alert1')
  var emailConnect=document.getElementById('emailConnect').value;
  var pswdConnect=document.getElementById('pswdConnect').value;
  alert1.innerHTML='';
  var etatFormConnect=true;

     if (emailConnect=='' || pswdConnect==''){

        alert1.innerHTML= 'Veuillez remplir tous les champs!';
        alert1.style.backgoundcolor='red';
        etatFormConnect=false;
     }
     else{
          if(!RegExpMail.test(emailConnect)){            //   test validité du mail
               alert1.innerHTML+='Format de courriel non valide !<br>';
               etatFormConnect=false;
              }

     }

     return etatFormConnect;


  }


function rendreVisible(elem){
  document.getElementById(elem).style.display='block';
}

function rendreInvisible(elem1, elem2, elem3){
  document.getElementById(elem1).style.display='none';
  document.getElementById(elem2).style.display='none';
  document.getElementById(elem3).style.display='none';
}

/****************-Effacer les messages d'Erreurs pour le bouton effacer****************/

function effacerFormulaire()
{   var alert=document.getElementById('alert');
     alert.innerHTML= "";
    
}



/****************-PANIER****************/
/****************-PANIER****************/


var panier = null;
    	localStorage.setItem("panier", '[]');

    	
    	function ajoutPanier(){
    		var nomProduit = document.getElementById("titreFilmp").innerHTML;
    		var categorie = document.getElementById("catFilmp").innerHTML;
    		var prix = document.getElementById("prixFilmp").innerHTML;
    		var achat = {nom: nomProduit, categorie: categorie, prix: prix};
    		panier=JSON.parse(localStorage.getItem("panier"));
    		panier.push(achat);
    		localStorage.setItem("panier", JSON.stringify(panier));
    		alert ('ok');

    		afficher();

    	}


		function afficher(){

			panier = JSON.parse(localStorage.getItem("panier"));


			var list = "<tr><th>Nom</th><th>Catégorie</th><th>Prix </th></tr>\n";
			
			for (chaqueArticle of panier){

			list += "<tr><td>" + chaqueArticle.nom + "</td>\n<td>"
					+ chaqueArticle.categorie + "</td>\n<td>"
					 + chaqueArticle.prix + " <button class='btn btn-danger' >Retirer</button></tr>\n";
			}
			//si liste vide 
			if (list == "<tr><th>Nom</th><th>Catégorie</th><th>Prix </th></tr>\n") {
        list += "<tr><th>.....</th><th>.....</th><th>.....</th></tr>\n";
        list+= "Panier vide...!"
			}
				
			document.getElementById('list').innerHTML = list;
			
		}


		

			function ClearAll() {
			var panier = [];
    	    localStorage.setItem("panier", '[]');
		}

  
    
      var boutonsSuppression = document.getElementsByClassName('btn-danger');

      for(i=0; i<boutonsSuppression.length; i++){
        var bouton = boutonsSuppression[i];
        bouton.addEventListener('click', function(event){
          var  boutonClicked = event.target
         boutonClicked.parentElement.parentElement.remove();
        })
       

      }
