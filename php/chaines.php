<?php

/**
 * Affichage d'espaces
 * @param int $nbEspaces nombre d'espaces à afficher
 */     
function espace($nbEspaces=1) {
  for ($k=0 ; $k<$nbEspaces ; $k++) {
    echo "&nbsp;" ;
  }
}

/**
 * Enlève un caractère sur 2 dans une chaîne
 * @param string $texte texte à modifier
 * @return string
 */     
function enleveUnSurDeux ($texte) {
  $result = "" ;
  $longueur = strlen($texte)-2 ;
  for ($k=0; $k<$longueur; $k+=2) {
    $result .= substr($texte, $k, 1) ;
  }
  return $result ;
}

?>