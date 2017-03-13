<?php

session_start () ;

// variables globales
$bdServeur = "localhost" ;
$bdUser = "root" ;
$bdMdp = "" ;
$bdBase = "boutique" ; 
$prixTshirt = 25 ;

// inclusion des autres fichiers
include_once ("chaines.php") ;
include_once ("curseurs.php") ;
include_once ("outils.php") ;

Connexion() ;

// récupération de l'éventuel cookie
if (isset($_COOKIE["login"])) {
  $leId = ($_COOKIE["login"] + 27) / 353 ;
  $curseur = mysql_query("select * from client where numclient=".$leId) ;
  if (mysql_num_rows($curseur)!=0) {
    $_SESSION["login"] = mysql_result($curseur, 0, "login") ;
    $_SESSION["id"] = mysql_result($curseur, 0, "numclient") ;
  }
}

// récupération des variables de session éventuelles
if (isset($_SESSION["login"])) {
  $login = $_SESSION["login"] ;
  $id = $_SESSION["id"] ;  
}else{
  $login = "" ;
  $id = "" ;
}

?>