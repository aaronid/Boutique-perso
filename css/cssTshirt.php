<?php 

//--- couleurs ---
$coulFondAjouts = "white" ;

//--- images ---
$imgTshirt = $cheminImg."tshirts/blanc.jpg" ;
$imgValid = $cheminImg."validation.png" ;

//--- tailles des objets ---
$hExplication = 60 ;
$wExplication = 440 ;
$hPalette = $hExplication ;
$wPalette = $hPalette ;
$hAjouts = 300 ;
$wAjouts = 200 ;
$hVisuel = 120 ;
$wVisuel = $hVisuel ;
$hTshirt = $hAjouts ;
$wTshirt = 300 ;
$hResultat = 300 ;
$wResultat = 120 ;
$wValidation = $wResultat ;
$hValidation = 60 ;

//--- positions des objets ---
$lExplication = 20 ;
$tExplication = 100 ;
$lPalette = $lExplication + $wExplication + 20 ;
$tPalette = $tExplication ;
$lAjouts = $lPalette + $wPalette - $wAjouts ;
$tAjouts = $tPalette + $hPalette + 10 ;
$lTshirt = $lExplication ;
$tTshirt = $tExplication + $hExplication + 10 ;
$lResultat = $lAjouts + $wAjouts + 20 ;
$tResultat = $tExplication ;
$lValidation = $lResultat ;
$tValidation = $tResultat + $hResultat + 10 ;

?>

.imgAjout {
  height:60px;
  width:60px;
}

#divExplication {
  width:<?php echo $wExplication ?>px; 
  height:<?php echo $hExplication ?>px;
  left:<?php echo $lExplication ?>px; 
  top:<?php echo $tExplication ?>px; 
  background-color:<?php echo $coulFondTexte ?>;   
}

#divPalette {
  width:<?php echo $wPalette ?>px; 
  height:<?php echo $hPalette ?>px;
  left:<?php echo $lPalette ?>px; 
  top:<?php echo $tPalette ?>px; 
  cursor:pointer;   
  background-color:<?php echo $coulFondTexte ?>;
}

#divAjouts {
  width:<?php echo $wAjouts ?>px; 
  height:<?php echo $hAjouts ?>px;
  left:<?php echo $lAjouts ?>px; 
  top:<?php echo $tAjouts ?>px; 
  background-color:<?php echo $coulFondAjouts ?>;
  overflow:auto;
}

#divTshirt {
  width:<?php echo $wTshirt ?>px; 
  height:<?php echo $hTshirt ?>px;
  left:<?php echo $lTshirt ?>px; 
  top:<?php echo $tTshirt ?>px; 
  background-image:url('<?php echo $imgTshirt ?>');
  background-repeat:no-repeat;  
}

#divResultat {
  width:<?php echo $wResultat ?>px; 
  height:<?php echo $hResultat ?>px;
  left:<?php echo $lResultat ?>px; 
  top:<?php echo $tResultat ?>px; 
  background-color:<?php echo $coulFondTexte ?>;   
}

#divVisuel {
  width:<?php echo $wVisuel ?>px; 
  height:<?php echo $hVisuel ?>px;   
  background-color:<?php echo $coulFondAjouts ?>;
  z-index:10;
}

/* la validation */
#divValidation {
  width:<?php echo $wValidation ?>px; 
  height:<?php echo $hValidation ?>px;
  left:<?php echo $lValidation ?>px; 
  top:<?php echo $tValidation ?>px; 
  overflow:none;  
}

#cmdValid {
  width:<?php echo $wValidation ?>px; 
  height:<?php echo $hValidation ?>px;
  left:0px; 
  top:0px; 
  background-image:url(<?php echo $imgValid ?>);  
  cursor:pointer;  
}

