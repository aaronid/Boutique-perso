<?php 

//--- couleurs ---

//--- images ---
$imgPlus = $cheminImg."plus.jpg" ;

//--- tailles des objets ---
$wArticles = 440 ;
$hArticles = 300 ;
$wSelection = 200 ;
$hSelection = $hResultat ;
$wtd1 = 40 ;
$wtd2 = 300 ;
$wtd3 = 30 ;
$wtd4 = 20 ;

//--- positions des objets ---
$lArticles = $lExplication ;
$tArticles = $tTshirt ;
$lSelection = $lArticles + $wArticles + 20 ;
$tSelection = $tResultat ;


?>

.imgBoutique {
  height:40px;
  width:40px;
}

/* la sélection */
#divSelection {
  width:<?php echo $wSelection ?>px; 
  height:<?php echo $hSelection ?>px;
  left:<?php echo $lSelection ?>px; 
  top:<?php echo $tSelection ?>px; 
  background-color:<?php echo $coulFondTexte ?>;   
  overflow:auto;
}

/* les articles */
#divArticles {
  width:<?php echo $wArticles ?>px; 
  height:<?php echo $hArticles ?>px;
  left:<?php echo $lArticles ?>px; 
  top:<?php echo $tArticles ?>px; 
  background-color:<?php echo $coulFondTexte ?>;   
  overflow:auto;
}

#tabArticles {
  border:0 ;
  width:95% ;
  valign:center ;  
}

.td1 {
  width:<?php echo $wtd1 ?>px ;
}

.td2 {
  align:left ;
  width:<?php echo $wtd2 ?>px ;
}

.td3 {
  align:right ;
  width:<?php echo $wtd3 ?>px ;
}

.td4 {
  align:center ;
  cursor:pointer;   
  width:<?php echo $wtd4 ?>px ;
}

#tSelection {
  border:0 ;
  width:95% ;
  valign:center ;  
}

