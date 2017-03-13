<?php include ("head.php") ; ?>

  <?php
  // initialisation des variables 
  $nom = "" ;
  $prenom = "" ;
  $adr1 = "" ;
  $adr2 = "" ;
  $cp = "" ;
  $ville = "" ;
  $infoslivraison = "" ;
  $tel = "" ;
  $mail = "" ;
  $login = "" ;
  $mdp = "" ;
  $mdpverif = "" ;

  // vérifie si la personne est connectée
  if (isset($_SESSION["id"])) { 
    // si elle est connectée, récupération de ses informations personnelles
    $curseur = mysql_query("select * from client where numclient = ".$_SESSION["id"]) ;
    $nom = mysql_result($curseur, 0, "nom") ;
    $prenom = mysql_result($curseur, 0, "prenom") ;
    $adr1 = mysql_result($curseur, 0, "adr1") ;
    $adr2 = mysql_result($curseur, 0, "adr2") ;
    $cp = mysql_result($curseur, 0, "cp") ;
    $ville = mysql_result($curseur, 0, "ville") ;
    $infoslivraison = mysql_result($curseur, 0, "infoslivraison") ;
    $tel = mysql_result($curseur, 0, "tel") ;
    $mail = mysql_result($curseur, 0, "mail") ;
    $login = mysql_result($curseur, 0, "login") ;
    $mdp = mysql_result($curseur, 0, "mdp") ;
    $mdpverif = mysql_result($curseur, 0, "mdp") ;
    $message = "Bienvenue dans votre espace personnel.<br />Vous pouvez consulter, modifier vos informations et les enregistrer." ;
  }else{
    // si c'est une nouvelle personne, message personnalisé (et les variables restent vides)
    $message = "Bienvenue dans l'espace d'inscription.<br />Saisissez vos informations. Les zones avec * sont obligatoires." ;
  }
  
  ?>

  <!-- zone d'explication -->
  <div id="divExplication">
    <div class="petitTitre">ESPACE PERSONNEL</div><br />
    <div class="petitTexte">
      <?php echo $message ?>
    </div>
  </div>

  <!-- zone d'affichage des informations -->
  <div id="divPerso" class="petitTexte">
  <?php           
    // affichage et saisie des informations de la personne
    $k = 0 ;
    $lesinfos = '<table id="tabPerso">' ;
    $lesinfos .= uneCase("login", "login", $login, 20, true) ;    
    $lesinfos .= uneCase("mdp", "mot de passe", $mdp, 20, true, true) ;    
    $lesinfos .= uneCase("mdpverif", "mot de passe (contrôle)", $mdpverif, 20, true, true) ;    
    $lesinfos .= uneCase("nom", "nom", $nom, 30, true) ;    
    $lesinfos .= uneCase("prenom", "prenom", $prenom, 30, true) ;    
    $lesinfos .= uneCase("adr1", "adresse", $adr1, 50, true) ;    
    $lesinfos .= uneCase("adr2", "complément adresse", $adr2, 50) ;    
    $lesinfos .= uneCase("cp", "code postal", $cp, 5, true) ;    
    $lesinfos .= uneCase("ville", "ville", $ville, 30, true) ;    
    $lesinfos .= uneCase("infoslivraison", "informations livraison", $infoslivraison, 50) ;    
    $lesinfos .= uneCase("tel", "téléphone", $tel, 10) ;    
    $lesinfos .= uneCase("mail", "adresse mail", $mail, 50) ;    
    $lesinfos .= "</table>" ;
    echo $lesinfos ;              
  ?>
</div>

<!-- zone d'affichage des factures -->
<div id="divSelection">
  <div class="petitTitre">vos factures</div><br />    
  <div class="petitTexte"> 
    en construction<br />
    l'historique de vos factures apparaitra ici 
  </div>                                                  
</div>

<!-- validation -->
<div id="divEnregistrer">
  <input id="cmdEnregistrer" type="button" value="Enregistrer" />
</div>

<?php include ("foot.php") ; ?>