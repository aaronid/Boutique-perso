<?php 
header('content-type:text/css') ; 

//--- couleurs ---
$coulFondTitre = "#AAAAAA" ;
$coulFondTexte = "#FFFFFF" ;
$coulFondMenu = "#333333" ;
$coulFondPied = "#666666" ;
$coulTexte = "#000000" ;

//--- tailles écriture ---
$tailleTitre = "small" ;
$tailleTexte = "x-small" ;

//--- images ---
$cheminImg = "../images/" ;
$imgPrincipal = $cheminImg."fond.jpg" ;
$imgTitre = $cheminImg."titre.jpg" ;

//--- tailles des objets ---
$wPrincipal = 700 ;
$hPrincipal = 500 ;
$hTitre = 60 ;
$hMenu = 20 ;
$hPied = 13 ;

?>

 
/**********************/
/*** styles communs ***/
/**********************/

a:link, a:visited{
  text-decoration:none ;
  color:<?php echo $coulFondTitre ?> ;
}    

a:active, a:hover{
  text-decoration:none ;
  color:<?php echo $coulFondTexte ?> ;
}    

div{
  overflow:hidden ;
  position:absolute ;
  font-family:verdana, serif ;
  font-size:<?php echo $tailleTitre ?> ;   
  color:<?php echo $coulFondTexte ?> ;    
}

.petitTitre{
  background-color:<?php echo $coulFondTitre ?> ; 
  font-weight:bold ;
  font-size:<?php echo $tailleTitre ?> ;   
  width:100% ;
  text-align : center ;
}

.petitTexte{
  font-size:<?php echo $tailleTexte ?> ;
  text-align : left ;
  color :<?php echo $coulTexte ?> ;
}

/************************/
/*** balises communes ***/
/************************/

/* principal */
#divPrincipal{
  left:50% ;
  top:50% ;
  width:<?php echo $wPrincipal ?>px ;
  height:<?php echo $hPrincipal ?>px ;
  margin-left:-<?php echo ($wPrincipal/2) ?>px ;
  margin-top:-<?php echo ($hPrincipal/2) ?>px ;  
  background-image:url('<?php echo $imgPrincipal ?>') ;
}

/* titre */ 
#divTitre{
  left:0px ;
  top:0px ;
  width:100% ;
  height:<?php echo $hTitre ?>px ;
  background-image:url('<?php echo $imgTitre ?>') ;
}

/* menu */ 
#divMenus{
  left:0px ;
  top:<?php echo $hTitre ?>px ;
  width:100% ;
  height:<?php echo $hMenu ?>px ;
  font-size:<?php echo $tailleTitre ?>;
  text-align:center;    
  background-color:<?php echo $coulFondMenu ?> ; 
}

/* pied */ 
#divPied{
  left:0px ;
  top:<?php echo ($hPrincipal-$hPied) ?>px ;
  width:100% ;
  height:<?php echo $hPied ?>px ;
  font-size:<?php echo $tailleTexte ?>;
  text-align:right;
  background-color:<?php echo $coulFondPied ?> ; 
}

<?php
include ("cssIndex.php") ;
include ("cssTshirt.php") ;
include ("cssBoutique.php") ;
include ("cssPerso.php") ;
?>