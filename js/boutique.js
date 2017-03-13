/*****************************************************************************
 * Chargement de la page
 * ***************************************************************************/ 
window.onload = function() {

  //--- récupération du nom de la page active ---
  var url = (document.location.href).split("/") ;
  var mapage = (url[url.length-1].split("."))[0] ;
                       
  //--- appel de la fonction correspondant à chaque page ---
  switch (mapage) {
    case "" : index () ; break ;
    case "index" : index () ; break ;
    case "perso" : perso () ; break ;
    case "boutique" : boutique () ; break ;
    case "tshirt" : tshirt () ; break ;
    case "panier" : panier () ; break ; 
  }

}

/*****************************************************************************
 * page index.php
 * ***************************************************************************/ 
function index () {

  //--- redimensionnement de la fenetre ---
  //dimposNavigateur ("divPrincipal", 50) ;

  //--- paramétrage dans le cas où javascript fonctionne ---
  document.getElementById("divNews").style.overflow = "hidden" ;

  //--- contrôle si la personne est reconnue ou non ---
  function majIdent () {
    if (document.getElementById("lblLogin").innerHTML=="") {
      document.getElementById("divTextIdent").style.visibility = "visible" ;
      document.getElementById("divTextBienvenu").style.visibility = "hidden" ;    
    }else{
      document.getElementById("divTextIdent").style.visibility = "hidden" ;
      document.getElementById("divTextBienvenu").style.visibility = "visible" ;
    }
    document.getElementById("txtLogin").value = "" ;
    document.getElementById("pwdMdp").value = "" ;
  }
  majIdent () ;

  //--- sur le clic du bouton ok ---
  document.getElementById("cmdOk").onclick = function() {
    if (document.getElementById("txtLogin").value=="" || document.getElementById("pwdMdp").value=="") {
      alert("les 2 champs doivent être remplis") ;
    }else{
      lelogin = document.getElementById("txtLogin").value ;
      lemdp = document.getElementById("pwdMdp").value ;
      AjaxReception("serveur.php?txtLogin="+lelogin+"&pwdMdp="+lemdp, "text", majLblLogin) ;
    }
  }
  
  //--- mise à jour du login si une personne est reconnue ---
  function majLblLogin (unLogin) {
    document.getElementById("lblLogin").innerHTML = unLogin ;
    majIdent() ;
  }
  
  //--- sur le clic du lien deconnecter ---
  document.getElementById("aDeconnecter").onclick = function() {
    AjaxEnvoi("serveur.php", "") ;
    document.getElementById("lblLogin").innerHTML = "" ;
    majIdent() ;
  }
  
  //--- lancement du défilement des news ---
  defile ("divTextNews", "divNews", 10) ;

  //--- préparation pour le défilement des images dans le bandeau ---
  function imageBandeau () {
    var cheminImages = "images/" ;
    var nbImages = 4 ;
    var tabNomsImages = new Array(nbImages) ;
    for (k=0 ; k<nbImages ; k++) {
      tabNomsImages[k] = cheminImages+"bandeau"+k+".jpg" ;
    }
    var lesImages = chargeImages(tabNomsImages) ;
    lesImages[lesImages.length-1].onload = function() {
      animImages("divImg0", "divImg1", lesImages) ;
    }
  }
  imageBandeau () ;
  
}

/*****************************************************************************
 * page perso.php
 * ***************************************************************************/ 
function perso () {

  //--- sur le clic du bouton enregistrer ---
  document.getElementById("cmdEnregistrer").onclick = function () {
  
    // récupération de tous les champs
    var nom = document.getElementById("nom").value ;
    var prenom = document.getElementById("prenom").value ;
    var adr1 = document.getElementById("adr1").value ;
    var adr2 = document.getElementById("adr2").value ;
    var cp = document.getElementById("cp").value ;
    var ville = document.getElementById("ville").value ;
    var infoslivraison = document.getElementById("infoslivraison").value ;
    var tel = document.getElementById("tel").value ;
    var mail = document.getElementById("mail").value ;
    var login = document.getElementById("login").value ;
    var mdp = document.getElementById("mdp").value ;
    var mdpverif = document.getElementById("mdpverif").value ;
    
    // contrôle si tous les champs obligatoires sont bien remplis  
    if (nom=="" || prenom=="" || adr1=="" || cp=="" || ville=="" || login=="" || mdp=="") {
      alert("certains champs obligatoires (*) n'ont pas été renseignés")
      
    // contrôle si les 2 mots de passe sont identiques
    }else{
      if (mdp != mdpverif) {
        alert("les 2 mots de passe ne sont pas identiques") ;

      // enregistrement des informations saisies si le login n'existe pas déjà
      }else{
        function controlLogin (existe) {
          if (existe=="vrai") {
            alert ("Le login choisi existe déjà : vous ne pouvez pas l'utiliser") ;
            document.getElementById("login").value = "" ;
          }else{
            function controlModif(reponse) {
              alert ("les informations ont été enregistrées") ;
              document.location.href = "index.php" ;
            }
            lachaine = "nom="+nom+"&prenom="+prenom+"&adr1="+adr1+"&adr2="+adr2+"&cp="+cp+"&ville="+ville+"&infoslivraison="+infoslivraison+"&tel="+tel+"&mail="+mail+"&login="+login+"&mdp="+mdp ;
            AjaxReception ("serveur.php?"+lachaine, "text", controlModif) ;
          }
        }
        AjaxReception ("serveur.php?controle="+login, "text", controlLogin)
      }
      
    }
    
  }

}


/*****************************************************************************
 * fonctions communes au panier et à la boutique
 * ***************************************************************************/ 

//--- visualisation en grand d'une image ---
function visualisation (unNum) {

        // sur le survol d'une image : image en grand
        document.getElementById("img"+unNum).onmouseover = function() {
          this.style.cursor = "pointer" ;
          // insertion de l'image dans un grand calque
          document.getElementById("divVisuel").style.visibility = "visible" ;        
          document.getElementById("divVisuel").style.backgroundImage = "url('"+this.src+"')" ;
          document.getElementById("divVisuel").style.top = decaleTop(this, document.getElementById("divPrincipal"), document.getElementById("divArticles"), 40)+"px" ; 
          document.getElementById("divVisuel").style.left = decaleLeft(this, document.getElementById("divPrincipal"), document.getElementById("divArticles"), 40)+"px" ; 
        }
        //--- lorsque la souris sort de la zone de l'image ---
        document.getElementById("img"+unNum).onmouseout = function() {
          // calque de visualisation rendu invisible
          document.getElementById("divVisuel").style.visibility = "hidden" ;
        }

}

//--- transfert d'un article dans la liste de droite ---
function ajoutRecap ( unId,             // l'id de l'article 
                      uneCorbeille) {   // true si ajout de corbeille

          var imgCorbeille = null ;
          
          // récupération du nom et du prix de l'article
          var article = document.getElementById("img"+unId) ;
          var prix = document.getElementById("lbl"+unId) ;
          
          // création d'une ligne du tableau
          var corps = document.createElement("tbody") ;
          corps.id = "b"+unId ;
          var ligne = document.createElement("tr") ;
          
          // case 1 avec le nom de l'article
          var case1 = document.createElement("td") ;
          var txtCase1 = document.createTextNode(article.alt) ;
          case1.appendChild(txtCase1) ;
          ligne.appendChild(case1) ;
          
          // case 2 avec le prix
          var case2 = document.createElement("td") ;
          var txtCase2 = document.createTextNode(prix.innerHTML+'€') ;
          case2.appendChild(txtCase2) ;
          ligne.appendChild(case2) ;
          
          // création de la corbeille si elle est demandée
          if (uneCorbeille) {
            var case3 = document.createElement("td") ;
            imgCorbeille = document.createElement("img") ;
            imgCorbeille.id = "corb"+unId ;
            imgCorbeille.src = "images/corbeille.jpg" ;
            imgCorbeille.style.cursor = "pointer" ;
            case3.appendChild(imgCorbeille) ;
            ligne.appendChild(case3) ;
            // sur le clic de la corbeille : suppression d'un élément
            imgCorbeille.onclick = function() {
              var numId = (this.id).substr(4, (this.id).length-4) ;
              var laLigne = document.getElementById('b'+numId) ;
              document.getElementById("tSelection").removeChild(laLigne) ;
              document.getElementById("ajout"+numId).style.visibility = "visible" ;           
              // suppression dans le panier de l'article supprimé
              AjaxEnvoi("serveur.php", "paniermoins="+numId) ;
           }
          }
          
          // intégration de la ligne dans le tableau
          corps.appendChild(ligne) ;
          document.getElementById("tSelection").appendChild(corps) ;
          
}

/*****************************************************************************
 * page boutique.php
 * ***************************************************************************/ 
function boutique () {

      var k = 0 ;
 
      document.getElementById("divVisuel").style.visibility = "hidden" ;

      //--- événements sur chaque article ---
      while (document.getElementById("img"+k)) {

        // gestion de la visualisation
        visualisation(k) ;

        // activation de la corbeille si l'élément est présent dans le panier
        if (document.getElementById("corb"+k)) {
          // sur le clic de la corbeille : suppression d'un élément
          document.getElementById("corb"+k).onclick = function() {
            var numId = (this.id).substr(4, (this.id).length-4) ;
            var laLigne = document.getElementById('b'+numId) ;
            document.getElementById("tSelection").removeChild(laLigne) ;
            document.getElementById("ajout"+numId).style.visibility = "visible" ;           
            // suppression dans le panier de l'article supprimé
            AjaxEnvoi("serveur.php", "paniermoins="+numId) ;
          }
        } 
      
        // sur le clic du + : ajout d'un élément
        document.getElementById("ajout"+k).onclick = function() {

          thisId = (this.id).substr(5, (this.id).length-5) ;

          // ajout d'une ligne dans le tableau résultats, avec corbeille
          ajoutRecap (thisId, true) ;

          // enregistrement dans le panier de l'article ajouté
          AjaxEnvoi("serveur.php", "panierplus="+thisId) ;

          // icone "plus" invisible pour interdire un nouvel ajout
          document.getElementById("ajout"+thisId).style.visibility = "hidden" ;
             
        }
        k++ ;
      }
 
}

/*****************************************************************************
 * page panier.php
 * ***************************************************************************/ 
function panier () {

      document.getElementById("divVisuel").style.visibility = "hidden" ;
    
      //--- événements sur chaque article ---
      k = 0 ;
 
      while (document.getElementById("img"+k)) {

        // gestion de la visualisation
        visualisation(k) ;
        // sur le clic de la corbeille : suppression d'un élément
        document.getElementById("suppr"+k).onclick = function() {
          var numId = (this.id).substr(5, (this.id).length-5) ;
          // suppression dans le panier de l'article supprimé
          AjaxEnvoi("serveur.php", "paniermoins="+document.getElementById("img"+numId).alt) ;    
          // modification du total
          document.getElementById("totalTicket").innerHTML = parseInt(document.getElementById("totalTicket").innerHTML) - parseInt(document.getElementById("prix"+numId).innerHTML) ;  
          // suppression des lignes
          var laLigne = document.getElementById('ppanier'+numId) ;
          document.getElementById("tPanier").removeChild(laLigne) ;
          laLigne = document.getElementById('b'+numId) ;
          document.getElementById("tSelection").removeChild(laLigne) ;
        }
        k++ ;
      }
      
      //--- cas particulier de la suppression du tshirt ---
      if (document.getElementById("supprtshirt"+k)) {
        document.getElementById("supprtshirt"+k).onclick = function() {
          var numId = (this.id).substr(11, (this.id).length-11) ;
          // suppression dans le panier de l'article supprimé
          AjaxEnvoi("serveur.php", "supprtshirt=") ;    
          // modification du total
          document.getElementById("totalTicket").innerHTML = parseInt(document.getElementById("totalTicket").innerHTML) - parseInt(document.getElementById("prix"+numId).innerHTML) ;  
          // suppression des lignes
          var laLigne = document.getElementById('ppanier'+numId) ;
          document.getElementById("tPanier").removeChild(laLigne) ;
          laLigne = document.getElementById('b'+numId) ;
          document.getElementById("tSelection").removeChild(laLigne) ;
        }      
      }
 
}

/*****************************************************************************
 * page tshirt.php                            
 * ***************************************************************************/ 
function tshirt () {

      var k ;
  
      //--- sur le clic sur la palette de couleur : changement de tshirt ---
      var couleur = new Array("blanc", "bleu", "gris", "jaune", "noir", "orange", "rouge", "vert", "mauve") ;
      document.getElementById("lblCouleur").innerHTML = couleur[0] ;
      for (k=0 ; k<couleur.length ; k++) {
        document.getElementById(couleur[k]).onclick = function() {
          document.getElementById("divTshirt").style.backgroundImage = 'url("images/tshirts/'+this.id+'.jpg")' ;
          // mise à jour de la zone résultat
          document.getElementById("lblCouleur").innerHTML = this.id ;
        }
      }  
    
      //--- gestion des ajouts ---
      document.getElementById("divVisuel").style.visibility = "hidden" ;
      var selection = null ;      // objet sélectionné sur le tshirt
      var sourisX ;  //ancienne position de la souris
      var sourisY ;
      var redim=false ; // tableau de booléen pour savoir si on redimentionne
      var totElements = 0 ;

      k = 0 ;
      while (document.getElementById("ajout"+k)) {
        //--- sur le survol d'un des ajouts possibles ---
        document.getElementById("ajout"+k).onmouseover = function() {
          this.style.cursor = "pointer" ;
          // insertion de l'image dans un calque de visualisation
          document.getElementById("divVisuel").style.visibility = "visible" ;        
          document.getElementById("divVisuel").style.backgroundImage = "url('"+this.src+"')" ;
          document.getElementById("divVisuel").style.top = decaleTop(this, document.getElementById("divPrincipal"), document.getElementById("divAjouts"), 40)+"px" ; 
          document.getElementById("divVisuel").style.left = decaleLeft(this, document.getElementById("divPrincipal"), document.getElementById("divAjouts"), 40)+"px" ; 
        }
        //--- lorsque la souris sort de la zone d'un ajout ---
        document.getElementById("ajout"+k).onmouseout = function() {
          // calque de visualisation rendu invisible
          document.getElementById("divVisuel").style.visibility = "hidden" ;
        }
      
        //--- sur le clic d'un des ajouts possibles ---
        document.getElementById("ajout"+k).onclick = function() {
          if (totElements>=5) {
            alert("Vous ne pouvez pas ajouter plus de 5 éléments") ;
          }else{
            totElements++ ;
            //--- ajout de l'élément dans la liste de résultat ---
            var nouvMessage = document.createElement("p") ;
            nouvMessage.id = "pel"+this.id ;
            nouvMessage.innerHTML = this.alt ;
            document.getElementById("pElements").appendChild(nouvMessage) ;
            //--- création de l'image de l'élément ---
            var nouvImage = document.createElement("img") ;
            nouvImage.src = this.src ;
            nouvImage.style.height = "100%" ;
            nouvImage.style.width = "100%" ;
            //--- création du calque qui contiendra l'image ---
            var nouvCalque = document.createElement("div") ;
            nouvCalque.style.height = "60px" ;
            nouvCalque.style.width = "60px" ;
            nouvCalque.style.top = "120px" ;
            nouvCalque.style.left = "120px" ;
            nouvCalque.style.cursor = "pointer" ;
            nouvCalque.id = "el"+this.id ;
            //--- intégration de l'image et du calque ---
            nouvCalque.appendChild(nouvImage) ;
            document.getElementById("divTshirt").appendChild(nouvCalque) ;
            //--- gestion des événements sur le calque ---
            // sur le doubleclic sur le tshirt : suppression de l'élément
            nouvCalque.ondblclick = function() {
              selection = null ;
              totElements-- ;
              document.getElementById("divTshirt").removeChild(this) ;  
              leMessage = document.getElementById("p"+this.id) ;
              document.getElementById("pElements").removeChild(leMessage) ;
            }        
            // sur le clic sur le tshirt : sélection de l'élément 
            nouvCalque.onmousedown = function(event) {
              // événement prédéfini sous IE
              if (window.event) {event=window.event;} ;  
              // récupération de l'objet et des infos sue le clic          
              selection = this ;
              sourisY = event.clientY ;
              sourisX = event.clientX ;
		          var leftbas=this.offsetWidth ;
  		        var topbas=this.offsetHeight ;
    		      var margeX = sourisX - getLeft(this) ;
	 	          var margeY = sourisY - getTop(this) ;
              redim=(margeX<=leftbas+20 && margeX>=leftbas-20 && margeY<=topbas+20 && margeY>=topbas-20);            
            }
          }
        }
        k++ ;
      }

      // sur le bouton laché de la souris : désélection de l'élément
      document.getElementById("divPrincipal").onmouseup = function() {
        selection = null ;
      }    
      
      // sur le glisser : déplacement de l'élément sélectionné
      document.getElementById("divPrincipal").onmousemove = function(event) {
        // événement prédéfini sous IE
        if (window.event) {event=window.event;} ;            
        // modification
        if (selection!=null) {
          // déplacement
          if (!redim) {
            selection.style.top = (selection.offsetTop + event.clientY - sourisY)+"px" ;
            selection.style.left = (selection.offsetLeft + event.clientX - sourisX)+"px" ;
          }else{
          // redimentionnement
            selection.style.height = (selection.offsetHeight + event.clientY - sourisY)+"px" ;
            selection.style.width = (selection.offsetWidth + event.clientX - sourisX)+"px" ;
          } 
          // enregistrement de la nouvelle position de la souris
          sourisY=event.clientY ;
          sourisX=event.clientX ;
        }
      }
      
      //--- enregistrement du t-shirt (juste la couleur) ---
      document.getElementById("cmdValid").onclick = function() {
        var lacouleur = document.getElementById("lblCouleur").innerHTML ;        
        AjaxEnvoi ("Serveur.php", "couleur="+lacouleur) ;     
        alert ("la couleur du t-shirt a été enregistrée") ; 
      }

      //--- contrôle si un tshirt a déjà été sélectionné ---
      function controlCouleur (uneCouleur) {
        if (uneCouleur!="") {
          document.getElementById("divTshirt").style.backgroundImage = 'url("images/tshirts/'+uneCouleur+'.jpg")' ;
          // mise à jour de la zone résultat
          document.getElementById("lblCouleur").innerHTML = uneCouleur ;      
        }
      }
      AjaxReception ("serveur.php?tshirt", "text", controlCouleur) ;

}

/*****************************************************************************
 * fonctions utilitaires
 * ***************************************************************************/
 
//--- défilement ---
function defile (idContenu, idConteneur, temps) {
 
  // fonction récursive pour gérer le défilement
  function go() {
    position-- ;
    if (position+hContenu < min) {
      position = max ;
      page = 0 ;
    }
    leContenu.style.top = position + "px" ;
    if (position+(max-min)*page <= min) {
      page++ ;
      leTimer = setTimeout(go, temps*100) ;
    }else{
      leTimer = setTimeout(go, temps) ;
    }
  } 
 
  // variables locales
  var leContenu = document.getElementById(idContenu) ;   
  var leConteneur = document.getElementById(idConteneur) ;  
  var hContenu = leContenu.offsetHeight ;
  var min = leContenu.offsetTop ;
  var max = leConteneur.offsetHeight ;
  var position = max ; 
  var page = 0 ;
  var leTimer ;
 
  // premier appel de la fonction go pour démarrer le défilement
  go () ;
  
  // événement survol sur calque conteneur
  leConteneur.onmouseover = function() {
    clearTimeout(leTimer) ;  
  }
  
  // événement fin de survol sur le calque conteneur
  leConteneur.onmouseout = function() {
    go () ;
  }
  
} 

//--- dimensionnement et positionnement du navigateur ---
function dimposNavigateur (idCalquePrincipal, marge) {

  var margeNavigateur = 100 ;
  var calque = document.getElementById(idCalquePrincipal) ;
  var hCalque = calque.offsetHeight ;
  var lCalque = calque.offsetWidth ;
  var hEcran = screen.availHeight ;
  var lEcran = screen.availWidth ;
  
  // calcul des coordonnées de la fenetre, après centrage
  var y = Math.max(0, hEcran - hCalque - 2*marge - margeNavigateur)/2 ;
  var x = Math.max(0, lEcran - lCalque - 2*marge)/2 ;
  
  // calcul de la taille de la fenetre en fonction du calque principal
  var hauteur = Math.min(hEcran, hCalque + 2*marge + margeNavigateur) ;
  var largeur = Math.min(lEcran, lCalque + 2*marge) ;
  
  // positionnement et dimensionnement de la fenetre
  moveTo(x, y) ;
  resizeTo(largeur, hauteur) ;
  
} 

//--- défilement horizontal d'un tableau d'images ---
function animImages (idImage1, idImage2, tabImages) {
 
  // fonction récursive de défilement des images
  function goAnime() {
    img[imgActive].style.width = largeur + "px" ;
    largeur -=  5 ;
    if (largeur <= 0) {
      // changement d'image
      numImage = (numImage + 1) % maxImages ;
      img[imgActive].style.backgroundImage = "url("+tabImages[numImage].src+")" ;
      // inversion dans le plan des images
      img[imgActive].style.zIndex = 1 ;
      img[imgActive].style.width = maxTaille + "px" ;
      imgActive = (imgActive + 1) % 2 ;
      img[imgActive].style.zIndex = 2 ;
      // redémarrage à la taille maximale
      largeur = maxTaille ;
      // pause avant de diminuer l'image
      setTimeout(goAnime, pause) ;
    }else{
      // continue l'animation
      setTimeout(goAnime, temps) ;
    }
  }
  
  // déclarations 
  var numImage = 0 ;
  var maxImages = tabImages.length ;
  var img = new Array() ;
  img[0] = document.getElementById(idImage1) ;
  img[1] = document.getElementById(idImage2) ;
  img[1].style.backgroundImage = "url("+tabImages[0].src+")" ;
  var maxTaille = tabImages[0].width ;
  var largeur = 0 ;
  var imgActive = 0 ;
  var temps = 1 ;
  var pause = temps * 2000 ;
  
  // démarrage de l'animation
  goAnime() ;
    
}

//--- chargement en mémoire d'un tableau d'images ---
function chargeImages (tabNoms) {
  var lesImages = new Array(tabNoms.length) ;
  for (k=0 ; k<tabNoms.length ; k++) {
    lesImages[k] = new Image() ;
    lesImages[k].src = tabNoms[k] ;
  }
  return lesImages ;
}

//--- pour connaitre la position d'un objet par rapport à la page ---
function getLeft(monObjet) {
  if (monObjet.offsetParent) {
    return (monObjet.offsetLeft + getLeft(monObjet.offsetParent)) ;
  } else {
    return (monObjet.offsetLeft) ;
  }
}

function getTop(monObjet) {
  if (monObjet.offsetParent) {
    return (monObjet.offsetTop + getTop(monObjet.offsetParent)) ;
  } else {
    return (monObjet.offsetTop) ;
  }
}

//--- pour retourner une position décalée par rapport à la position d'un objet ---
function decaleTop(objet, principal, conteneurscroll, taille) {
  return (getTop(objet) - getTop(principal) - conteneurscroll.scrollTop + taille) ; 
}

function decaleLeft(objet, principal, conteneurscroll, taille) {
  return (getLeft(objet) - getLeft(principal) - conteneurscroll.scrollLeft + taille) ; 
}

/*****************************************************
 * AJAX
 * ***************************************************/

function Ajax () {
  
  //--- propriétés ---
  xhr = null ;        // variable de connexion ajax
 
  //--- constructeur (création de l'objet de connexion ---
  if (window.XMLHttpRequest) {
    xhr = new XMLHttpRequest() ; 	
  } else {
    if (window.ActiveXObject) {
      xhr = new ActiveXObject ("Microsoft.XMLHTTP") ; 		 
    } else {
      alert ("Votre navigateur n'est pas compatible avec Ajax") ;
	  }	
  }

  return xhr ;
}

function AjaxReception (nomfic, typefic, uneFonction) {
  
  //--- propriétés ---
  xhr = Ajax() ;        // variable de connexion ajax
 
  //--- si l'objet est construit, creation de la méthode de récupération ---
  if (xhr) {
    //--- réception du serveur ---	   
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) { 
	      if (typefic=="XML") {
          uneFonction(xhr.responseXML) ;
			  } else {   
          uneFonction(xhr.responseText) ;
			  }
		  }
	  }
    xhr.open("GET", nomfic, true) ;  
    xhr.send(null) ;
  }
   
}

function AjaxEnvoi (nomfic, message) {
  
  //--- propriétés ---
  xhr = Ajax() ;        // variable de connexion ajax
 
  //--- si l'objet est construit, envoi possible ---
  if (xhr) {
	   
    //--- envoi vers le serveur ---
    xhr.open("POST", nomfic, true) ;
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(message) ;

  }
   
}


