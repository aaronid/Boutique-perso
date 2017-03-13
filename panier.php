<?php include ("head.php") ;

//--- panier non accessible si la personne n'est pas reconnue ---
if (!isset($_SESSION["id"])) { ?>

<div id="divExplication">
  <div class="petitTitre">PANIER</div><br />
  <div class="petitTexte">
    Attention le panier n'est accessible que si vous êtes reconnu.<br />
    Identifiez-vous sur la page accueil, ou créez un nouveau compte sur la page<br />
    votre espace perso.
  </div>
</div>

<?php 
}else{ ?>

<div id="divExplication">
  <div class="petitTitre">PANIER</div><br />
  <div class="petitTexte">
    Votre panier contient les articles et le t-shirt que vous avez choisis :<br />
    vous pouvez supprimer des éléments de votre sélection.<br />
    Pensez à enregistrer votre panier pour passer au paiement.
  </div>
</div>

<div id="divArticles" class="petitTexte">
  <?php           
  
    //--- création du tableau pour afficher les articles ---
    $k = 0 ;        // indice sur tous les articles
    $i = 0 ;        // indice sur les articles du panier      
    $total = 0 ;    // calcul du total de la facture
    $lesarticles = '<table id="tPanier">' ;
    $leticket = '<table id="tSelection">' ;
    $chemin = "images/articles/" ;
    $flux = dir($chemin) ;

    //--- boucle sur tous les articles du dossier ---
    while ($fic = $flux->read()) {
      $ficComplet = $chemin.$fic ;
      // si le fichier est une image
      if ($fic!="." && $fic!=".." && exif_imagetype ($ficComplet)) {
      
        //--- récupération de l'article que s'il est dans le panier ---
        $curseur = mysql_query("select * from panier where idclient=".$id." and idarticle=".$k) ;
        if (mysql_num_rows($curseur)!=0) {
          $nom = substr($fic,0,strlen($fic)-4) ;
          // récupération des informations du fichier image
          $infos = exif_read_data($ficComplet, 0, true) ;
          $titre = enleveUnSurDeux($infos["IFD0"]["Title"]) ;
          $sujet = enleveUnSurDeux($infos["IFD0"]["Subject"]) ;
          $commentaire = enleveUnSurDeux($infos["IFD0"]["Comments"]) ;
          // construction de la ligne à gauche   
          $lesarticles .= '<tbody id="ppanier'.$i.'"><tr id="trpanier'.$i.'">' ;    
          $lesarticles .= '<td class="td1"><img id="img'.$i.'" src="'.$ficComplet.'" alt="'.$k.'" class="imgBoutique" /></td>' ; 
          $lesarticles .= '<td class="td2">'.$titre.'<br />'.$commentaire.'</td>' ;
          $lesarticles .= '<td class="td3"><label>'.$sujet.'</label>€</td>' ;
          $lesarticles .= '<td class="td4"><img id="suppr'.$i.'" src="images/corbeille.jpg" alt="supprimer" /></td>' ;
          $lesarticles .= '</tr></tbody>' ;
          // construction de la ligne dans le ticket
          $leticket .= '<tbody id="b'.$i.'"><tr id="trticket'.$i.'">' ;    
          $leticket .= '<td class="td2">'.$titre.'</td>' ;
          $leticket .= '<td class="td3"><label id="prix'.$i.'">'.$sujet.'</label>€</td>' ;
          $leticket .= '</tr></tbody>' ;
          $total += $sujet ;
          
          $i++ ;
        }
        $k++ ;
      } 
    }
    $flux->close() ;
    
    // ajout d'une ligne s'il y a un tshirt 
    if (isset($_SESSION["couleur"])) {
      $nom = $_SESSION["couleur"] ;
      $ficComplet = "images/tshirts/".$nom.".jpg" ;
      // récupération des informations du tshirt
      $titre = "t-shirt ".$nom ;
      $sujet = $prixTshirt ;
      $commentaire = "vous avez choisi un tshirt personnalisé." ;    
      // construction de la ligne à gauche   
      $lesarticles .= '<tbody id="ppanier'.$i.'"><tr id="trpanier'.$i.'">' ;    
      $lesarticles .= '<td class="td1"><img id="imgtshirt" src="'.$ficComplet.'" alt="'.$k.'" class="imgBoutique" /></td>' ; 
      $lesarticles .= '<td class="td2">'.$titre.'<br />'.$commentaire.'</td>' ;
      $lesarticles .= '<td class="td3"><label>'.$sujet.'</label>€</td>' ;
      $lesarticles .= '<td class="td4"><img id="supprtshirt'.$i.'" src="images/corbeille.jpg" alt="supprimer" /></td>' ;
      $lesarticles .= '</tr></tbody>' ;
      // construction de la ligne dans le ticket
      $leticket .= '<tbody id="b'.$i.'"><tr id="trticket'.$i.'">' ;    
      $leticket .= '<td class="td2">'.$titre.'</td>' ;
      $leticket .= '<td class="td3"><label id="prix'.$i.'">'.$sujet.'</label>€</td>' ;
      $leticket .= '</tr></tbody>' ;      
      $total += $prixTshirt ;
    }
    
    // calcul du total du ticket
    $leticket .= '<tbody><tr id="trticket'.$i.'">' ;    
    $leticket .= '<td class="td2"><strong>TOTAL :</strong></td>' ;
    $leticket .= '<td class="td3"><strong><label id="totalTicket">'.$total.'</label>€</strong></td>' ;
    $leticket .= '</tr></tbody>' ;
    $leticket .= "</table>" ;
    
    // affichage dans la liste de gauche
    $lesarticles .= "</table>" ;
    echo $lesarticles ;              
  ?>
</div>

<div id="divSelection">
  <div class="petitTitre">votre ticket</div><br />    
  <div class="petitTexte"> 
    <?php echo $leticket ?> 
  </div>                                                  
</div>

<div id="divVisuel"></div>

<?php 
}

include ("foot.php") ; ?>