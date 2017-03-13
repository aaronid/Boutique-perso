<?php

/**
 * Création d'un case de tableau
 * @param string $nom id de la case
 * @param string $titre nom de l'attribut
 * @param string $contenu contenu de l'attribut
 * @param int $taille longueur de la zone de saisie
 * @param bool $obligatoire ajout de * si obligatoire
 * @param bool password zone de type mot de passe
 * @return string
 */     
function uneCase($nom, $titre, $contenu, $taille, $obligatoire=false, $password=false) {
  $case = '<tr>' ;    
  $case .= '<td class="td1p">'.$titre ; 
  if ($obligatoire) {
    $case .= '*' ; 
  }
  $case .= ' :</td>' ; 
  $case .= '<td class="td2p">' ;
  $case .= '<input id="'.$nom.'"' ;
  if ($password) {
    $case .= ' type="password"' ;
  }else{
    $case .= ' type="text"' ;
  }
  $case .= ' maxlength="'.$taille.'" size="'.$taille.'" class="petitTexte" value="'.$contenu.'" /></td>' ;
  $case .= '</tr>' ;    
  return $case ;
}

?>