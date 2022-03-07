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

function rendreInvisible2(elem1){
  document.getElementById(elem1).style.display='none';}

/****************-Effacer les messages d'Erreurs pour le bouton effacer****************/

function effacerFormulaire()
{   var alert=document.getElementById('alert');
     alert.innerHTML= "";
    
}



/****************-PANIER****************/
/****************-PANIER****************/


    function panier(){
       

        const btnaddToCart = document.getElementsByClassName("addToCart");
        let items =[];
        
        for (var i = 0; i<btnaddToCart.length; i++){
          btnaddToCart[i].addEventListener("click", function(e){
      //      console.log(e.target.parentElement.parentElement.children[4].children[1].textContent);

            let item = {

              name: e.target.parentElement.parentElement.children[0].textContent,
              prix: e.target.parentElement.children[1].textContent,
              no:1
              
            };

            if(JSON.parse(localStorage.getItem('items')) === null){ //  si localStorage vide

              items.push(item);                 // mettre article dans tableau items

              localStorage.setItem("items",JSON.stringify(items)); // initialiser le localstorage
              window.location.reload();
            }
            else{                             // autrement
              const localItems = JSON.parse(localStorage.getItem("items"));  // verifier contenu localStorage
              localItems.map(data=>{
                
                if(item.name == data.name){                  // deja existant, on ajoute 1
                  item.no = data.no + 1;

                  
                }
                else{

                  items.push(data);   // mettre data  dans tableau items
                }

              });
              items.push(item);
              localStorage.setItem("items",JSON.stringify(items));
              window.location.reload();


            }

            

          });
        }


        // affichagenombre element dans localstorage comme contenu


      const compteurArticle = document.querySelector('.modalPanier span');
      let no = 0;
      JSON.parse(localStorage.getItem("items")).map(data =>{
        no = no + data.no;

      });

      compteurArticle.innerHTML = no;

        // affichage dans tableau
      const cartBox = document.querySelector(".cartBoxe");
      const cartBoxTable = cartBox.querySelector('table');
      let totalPanier = 0;
      let list = '';
      list += "<tr><th>Nom</th><th>Quantité</th><th>Prix </th><th>Action</th></tr>";

      if(JSON.parse(localStorage.getItem("items"))[0] === null){
        list += "<tr><td colspan='4' >***Panier vide, aucun article ajouté...!</td></tr>";
      }else{


          JSON.parse(localStorage.getItem("items")).map(data=>{

          list += "<tr><td>"+data.name+"</td><td>"+data.no+"</td><td>"+data.prix*data.no+"</td><td><a href=# class='btn btn-info' onclick=supprimerLigne(this);>Supprimer</a></td></tr>";

            totalPanier +=data.prix*data.no;
          });


      }

      cartBoxTable.innerHTML = list + "<tr><td colspan='4' > Votre Total avant taxe: $ <b>"+ totalPanier+"</b></td></tr>";
      





    }
// Lors du click, si localStorage avec la clé items est vide alors les infos (item) sont mis dans le tableau items et localStorage est initialisé avec le tableau items.
//si local =Storage avec la clé items est non vide alors on veriefie la presence de l'element parmis ceux deja dans localStorage. Si present on increment sinon on ajoute.

// ajout dans l'icone du panier

function supprimerLigne(e){
            let items = [];
            JSON.parse(localStorage.getItem("items")).map(data=>{
              if(data.name !== e.parentElement.parentElement.children[0].textContent){
                items.push(data);
              }


            });

            localStorage.setItem("items", JSON.stringify(items));
            window.location.reload();

          }



