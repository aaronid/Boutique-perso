<?php       
include_once("php/init.php") ;
Connexion() ;

//--- demande et contrôle d'identification ---
if (isset($_GET["txtLogin"])) {
  $login = $_GET["txtLogin"] ;
  $mdp = $_GET["pwdMdp"] ;

  $curseur = mysql_query("select * from client where login='".$login."' and mdp='".$mdp."'") ;
  if (mysql_num_rows($curseur)!=0) {
    $_SESSION["login"] = $login ;
    $_SESSION["id"] = mysql_result($curseur, 0, "numclient") ;
    setcookie("login", $_SESSION["id"] * 353 - 27, time()+60*60*24*3600) ;
    echo $login ;
  }else{
    echo "" ;
  }

//--- enregistrement de la couleur du tshirt ---
}elseif (isset($_POST["couleur"])) {
  $_SESSION["couleur"] = $_POST["couleur"] ;

//--- controle si une couleur de tshirt a éjà été sélectionnée ---
}elseif (isset($_GET["tshirt"])) {
  if (isset($_SESSION["couleur"])) {
    echo $_SESSION["couleur"] ;
  }else{
    echo "" ;
  }
  
//--- supprimer l'enregistrement de la couleur du tshirt ---
}elseif (isset($_POST["supprtshirt"])) {
  session_unregister("couleur") ;

//--- insertion d'un article dans le panier (si la personne est identifiée) ---
}elseif (isset($_POST["panierplus"])) {
  if (isset($_SESSION["id"])) {
    mysql_query("insert into panier values( ".$_SESSION["id"].", ".$_POST["panierplus"].")") ;
  }

//--- suppression d'un article du panier (si la personne est identifiée) ---
}elseif (isset($_POST["paniermoins"])) {
  if (isset($_SESSION["id"])) {
    mysql_query("delete from panier where idclient=".$_SESSION["id"]." and idarticle=".$_POST["paniermoins"]) ;
  }

//--- contrôle si le login saisi n'existe pas déjà ---
}elseif (isset($_GET["controle"])) {
  $login = $_GET["controle"] ;
  $curseur = mysql_query("select * from client where login='".$login."'") ;
  if (mysql_num_rows($curseur)==0) {
    echo "faux" ;
  }elseif (!isset($_SESSION["id"])) {
    echo "vrai" ;
  }elseif ($_SESSION["id"]!=mysql_result($curseur, 0, "numclient")) {
    echo "vrai" ;
  }else{
    echo "faux" ;
  }

//--- enregistrement des informations de la personne ---
}elseif (isset($_GET["login"])) {
  // récupération de toutes les informations
  $nom = $_GET["nom"] ;
  $prenom = $_GET["prenom"] ;
  $adr1 = $_GET["adr1"] ;
  $adr2 = $_GET["adr2"] ;
  $cp = $_GET["cp"] ;
  $ville = $_GET["ville"] ;
  $infoslivraison = $_GET["infoslivraison"] ;
  $tel = $_GET["tel"] ;
  $mail = $_GET["mail"] ;
  $login = $_GET["login"] ;
  $mdp = $_GET["mdp"] ;

  // ajoute ou modifie (suivant si la personne existe ou non)
  if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"] ; 
    $requete = 'update client set nom="'.$nom.'", prenom="'.$prenom.'", adr1="'.$adr1.'", adr2="'.$adr2.'", cp="'.$cp.'", ville="'.$ville.'", infoslivraison="'.$infoslivraison.'", tel="'.$tel.'", mail="'.$mail.'", login="'.$login.'", mdp="'.$mdp.'" where numclient='.$id ;
    mysql_query($requete) ;
  }else{
    $requete = 'insert into client values ("", "'.$nom.'", "'.$prenom.'", "'.$adr1.'", "'.$adr2.'", "'.$cp.'", "'.$ville.'", "'.$infoslivraison.'", "'.$tel.'", "'.$mail.'", "'.$login.'", "'.$mdp.'")' ;
    mysql_query($requete) ;
    $id = mysql_insert_id() ;
  }

  // met à jour les variables de session et le cookie
  $_SESSION["login"] = $login ;
  $_SESSION["id"] = $id ;
  setcookie("login", $id * 353 - 27, time()+60*60*24*3600) ;

}else{
  // demande de déconnexion
  session_unregister("login") ;
  session_unregister("id") ;
  setcookie("login", "", time() - 3600) ;
}

//header("location:index.php") ;
?>