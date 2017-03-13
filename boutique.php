<?php include ("head.php") ; ?>

<div id="divExplication">
  <div class="petitTitre">BOUTIQUE</div><br />
  <div class="petitTexte">
    vous pouvez voir l'article en grand en passant la souris sur l'image<br />
    cliquez sur + pour ajouter l'article au panier<br />
    il n'y a qu'un exemplaire de chaque article vendu
  </div>
</div>

<div id="divArticles" class="petitTexte">
  <?php           
    $k = 0 ;
    $lesarticles = '<table id="tabArticles">' ;       // tableau de gauche
    $laselection = '<table id="tSelection">' ;        // tableau de droite
    $chemin = "images/articles/" ;
    $flux = dir($chemin) ;
    while ($fic = $flux->read()) {
      // vérifie si l'article est déjà présent dans le panier
      $articlePresent = false ;
      if (isset($_SESSION["id"])) {
        $curseur = mysql_query("select * from panier where idclient=".$_SESSION["id"]." and idarticle=".$k) ;
        $articlePresent = (mysql_num_rows($curseur)!=0) ;
      }
      // parcours des fichiers des articles dans le dossier      
      $ficComplet = $chemin.$fic ;
      // si le fichier est une image
      if ($fic!="." && $fic!=".." && exif_imagetype ($ficComplet)) {
        $nom = substr($fic,0,strlen($fic)-4) ;
        // récupération des informations du fichier image
        $infos = exif_read_data($ficComplet, 0, true) ;
        $titre = enleveUnSurDeux($infos["IFD0"]["Title"]) ;
        $sujet = enleveUnSurDeux($infos["IFD0"]["Subject"]) ;
        $commentaire = enleveUnSurDeux($infos["IFD0"]["Comments"]) ;
        // construction de la ligne de gauche   
        $lesarticles .= '<tr>' ;    
        $lesarticles .= '<td class="td1"><img id="img'.$k.'" src="'.$ficComplet.'" alt="'.$titre.'" class="imgBoutique" /></td>' ; 
        $lesarticles .= '<td class="td2">'.$titre.'<br />'.$commentaire.'</td>' ;
        $lesarticles .= '<td class="td3"><label id="lbl'.$k.'">'.$sujet.'</label>€</td>' ;
        if ($articlePresent) {
          $lesarticles .= '<td class="td4"><img id="ajout'.$k.'" src="images/plus.jpg" alt="ajouter" style="visibility:hidden" /></td>' ;
        }else{
          $lesarticles .= '<td class="td4"><img id="ajout'.$k.'" src="images/plus.jpg" alt="ajouter" /></td>' ;
        }
        $lesarticles .= '</tr>' ;
        // construction de la ligne dans le récapitulatif si panier en cours
        if ($articlePresent) {
          $laselection .= '<tbody id="b'.$k.'"><tr>' ;    
          $laselection .= '<td>'.$titre.'</td>' ; 
          $laselection .= '<td>'.$sujet.'€</td>' ;
          $laselection .= '<td><img id="corb'.$k.'" src="images/corbeille.jpg" alt="supprimer" style="cursor:pointer" /></td>' ;
          $laselection .= '</tr><tbody>' ;            
        }
        $k++ ;
      } 
    }
    $flux->close() ;
    $lesarticles .= "</table>" ;
    $laselection .= "</table>" ;
    echo $lesarticles ;              
  ?>
</div>

<div id="divSelection">
  <div class="petitTitre">votre sélection</div><br />    
  <div class="petitTexte"> 
    <?php echo $laselection ?> 
  </div>                                                  
</div>

<div id="divVisuel"></div>

<?php include ("foot.php") ; ?>