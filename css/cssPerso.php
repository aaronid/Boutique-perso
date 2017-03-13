<?php 

//--- couleurs ---

//--- images ---
$imgEnreg = $cheminImg."enregistrer.png" ;

//--- tailles des objets ---
$wArticles = 440 ;
$hArticles = 300 ;
$wSelection = 200 ;
$hSelection = $hResultat ;
$wtd1 = 170 ;
$wtd2 = 260 ;
$wEnregistrer = $wSelection ;
$hEnregistrer = 60 ;

//--- positions des objets ---
$lArticles = $lExplication ;
$tArticles = $tTshirt ;
$lSelection = $lArticles + $wArticles + 20 ;
$tSelection = $tResultat ;
$lEnregistrer = $lSelection ;
$tEnregistrer = $tSelection + $hSelection + 10 ;



?>

/* la liste des factures */
#divFactures {
  width:<?php echo $wSelection ?>px; 
  height:<?php echo $hSelection ?>px;
  left:<?php echo $lSelection ?>px; 
  top:<?php echo $tSelection ?>px; 
  background-color:<?php echo $coulFondTexte ?>;   
  overflow:auto;
}

/* les informations personnelles */
#divPerso {
  width:<?php echo $wArticles ?>px; 
  height:<?php echo $hArticles ?>px;
  left:<?php echo $lArticles ?>px; 
  top:<?php echo $tArticles ?>px; 
  background-color:<?php echo $coulFondTexte ?>;   
  overflow:auto;
}

#tabPerso {
  border:0 ;
  width:95% ;
  valign:center ;  
}

.td1p {
  width:<?php echo $wtd1 ?>px ;
}

.td2p {
  align:left ;
  width:<?php echo $wtd2 ?>px ;
}

/* la validation */
#divEnregistrer {
  width:<?php echo $wEnregistrer ?>px; 
  height:<?php echo $hEnregistrer ?>px;
  left:<?php echo $lEnregistrer ?>px; 
  top:<?php echo $tEnregistrer ?>px; 
  overflow:none;  
}

#cmdEnregistrer {
  width:<?php echo $wEnregistrer ?>px; 
  height:<?php echo $hEnregistrer ?>px;
  left:0px; 
  top:0px; 
  background-image:url(<?php echo $imgEnreg ?>);    
  cursor:pointer;
}


