<?php 

//--- images ---
$imgBandeau = $cheminImg."bandeau0.jpg" ;
$imgIdent = $cheminImg."ident.png" ;
$imgNews = $cheminImg."news.png" ;
$imgLiens = $cheminImg."lien.png" ;

//--- tailles des objets ---
$hBandeau = 100 ;
$wPostits = 328 ;
$hPostits = 220 ;
$hIdent = 60 ;
$wIdent = 160 ;
$wTextIdent = $wIdent - 40 ;
$wNews = 250 ;
$hNews = 195 ;
$hImgNews = 75 ;
$hPied = 13 ;

//--- positions des objets ---
$lPostits = 350 ;
$tPostits = 160 ;
$lIdent = 30 ;
$lTextIdent = 40 ;
$lNews = $lIdent ;
$tNews = $tPostits + $hPostits/2 + 10 ;
$tLiens = 430 ;
$tIdent = $tPostits + ($hPostits-20)/2 - $hIdent ;

?>

/* bandeau */ 
#divBandeau{
  left:0px ;
  top:<?php echo ($hTitre+$hMenu) ?>px ;
  width:100% ;
  height:<?php echo $hBandeau ?>px ;    
}

#divImg0, #divImg1{
  width:100% ;
  height:100% ;
  background-image:url('<?php echo $imgBandeau ?>') ;
}

/* postits */
div.divPostit{
  width:<?php echo (($wPostits-20)/2) ?>px ;
  height:<?php echo (($hPostits-20)/2) ?>px ;
  background-color:<?php echo $coulFondTitre ?> ; 
  text-align:center ;
}

#divPostits{
  left:<?php echo $lPostits ?>px ;
  top:<?php echo $tPostits ?>px ;
  width:<?php echo $wPostits ?>px ;
  height:<?php echo $hPostits ?>px ;
}

#divPostit1{
  left:0px ;
  top:0px ;
  z-index:10 ;
}

#divPostit2{
  left:<?php echo (($wPostits/2)+10) ?>px ;
  top:0px ;
  z-index:10 ;
}

#divPostit3{
  left:0px ;
  top:<?php echo (($hPostits/2)+10) ?>px ;
}

#divPostit4{
  left:<?php echo (($wPostits/2)+10) ?>px ;
  top:<?php echo (($hPostits/2)+10) ?>px ;
}

/* identification */
#divIdent{
  left:<?php echo $lIdent ?>px ;
  top:<?php echo $tIdent ?>px ;
  width:<?php echo $wIdent ?>px ;
  height:<?php echo $hIdent ?>px ;
  background-color:<?php echo $coulFondTexte ?> ; 
  background-image:url('<?php echo $imgIdent ?>') ;
  background-repeat:no-repeat ;
}

#divTextIdent{
  left:<?php echo $lTextIdent ?>px ;
  top:0px ;
  width:<?php echo $wTextIdent ?>px ;
  height:100% ;   
}

#divTextBienvenu{
  left:<?php echo $lTextIdent ?>px ;
  top:0px ;
  width:<?php echo $wTextIdent ?>px ;
  height:100% ;
  visibility:hidden ;  
}

/* news */
#divNews{
  left:<?php echo $lNews ?>px ;
  top:<?php echo $tNews ?>px ;
  width:<?php echo $wNews ?>px ;
  height:<?php echo $hNews ?>px ;
  background-color:<?php echo $coulFondTexte ?> ; 
  overflow:auto ;
}

#divImgNews{
  width:100% ;
  height:<?php echo $hImgNews ?>px ;
  background-image:url('<?php echo $imgNews ?>') ;
  background-repeat:no-repeat ;
  z-index:1 ;
}

#divTextNews{
  left:0px ;
  top:<?php echo $hImgNews ?>px ;
  width:100% ;
  background-color:<?php echo $coulFondTexte ?> ; 
}

/* liens */ 
#divLiens{
  left:<?php echo $lPostits ?>px ;
  top:<?php echo $tLiens ?>px ;
  width:<?php echo $wPostits ?>px ;
  height:<?php echo ($tNews+$hNews-$tLiens) ?>px ;
  background-color:<?php echo $coulFondTexte ?> ; 
  background-image:url('<?php echo $imgLiens ?>') ;
  background-repeat:no-repeat ;
}

#divTextLiens{
  left:50px ;
  top:0px ;
  width:100% ;
  height:100% ;
}
