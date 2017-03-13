<?php

/**
 * Affichage d'espaces
 * @param int $nbEspaces nombre d'espaces � afficher
 */     
function espace($nbEspaces=1) {
  for ($k=0 ; $k<$nbEspaces ; $k++) {
    echo "&nbsp;" ;
  }
}

/**
 * Enl�ve un caract�re sur 2 dans une cha�ne
 * @param string $texte texte � modifier
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