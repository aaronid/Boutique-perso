<?php include ("head.php") ; ?>

<!-- zone d'explication -->
<div id="divExplication">
  <div class="petitTitre">T-SHIRT PERSONNALISE</div><br />
  <div class="petitTexte">
    choisissez la couleur de votre t-shirt dans la palette<br />
    sélectionnez une ou plusieurs images (5 max) pour les ajouter sur le t-shirt<br />
    positionnez et redimentionnez l'image (doube-clic pour supprimer l'image)
  </div>
</div>

<!-- palette de couleurs -->
<div id="divPalette">
  <?php                
    $lescouleurs = "" ;
    $chemin = "images/palette/" ;
    $flux = dir($chemin) ;
    while ($fic = $flux->read()) {
      $ficComplet = $chemin.$fic ;
      // si le fichier est une image
      if ($fic!="." && $fic!=".." && exif_imagetype ($ficComplet)) {
        $couleur = substr($fic,0,strlen($fic)-4) ;
        $lescouleurs .= '<img id ="'.$couleur.'" src="'.$ficComplet.'" alt="'.$couleur.'" />' ; 
      } 
    }
    $flux->close() ;
    echo $lescouleurs ;               
  ?>
</div>

<!-- zones des ajouts possibles -->
<div id="divAjouts">
  <?php             
    $k = 0 ;
    $lesajouts = "" ;
    $chemin = "images/ajouts/" ;
    $flux = dir($chemin) ;
    while ($fic = $flux->read()) {
      $ficComplet = $chemin.$fic ;
      // si le fichier est une image
      if ($fic!="." && $fic!=".." && exif_imagetype ($ficComplet)) {
        $nom = substr($fic,0,strlen($fic)-4) ;
        $lesajouts .= '<img id ="ajout'.$k++.'" src="'.$ficComplet.'" alt="'.$nom.'" class="imgAjout" />' ; 
      } 
    }
    $flux->close() ;
    echo $lesajouts ;          
  ?>
</div>

<!-- petite zone de visualisation (pour voir les images en plus grand) -->
<div id="divVisuel">
</div>

<!-- zones de la construction t-shirt -->
<div id="divTshirt"></div>

<!-- zones du résultat : détail textuel du t-shirt -->
<div id="divResultat">  
  <div class="petitTitre">vos choix</div><br />
  <div class="petitTexte">         
    <br />
    <strong>couleur : </strong><label id="lblCouleur"></label><br /><br /><br />
    <strong>éléments :</strong>
    <p id="pElements"></p>        
  </div>                    
</div>

<!-- validation -->
<div id="divValidation">
  <input id="cmdValid" type="button" value="Enregistrer" />
</div>

<?php include ("foot.php") ; ?>