<?php include ("php/init.php") ; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="author" content="Ed" />
  <meta name="keywords" content="boutique, t-shirt" />
  <meta name="description" content="Vente de t-shirts et objets de collection" />
  <meta name="date" content="2009-08-01T12:10:15+01:00" />
  <script type="text/javascript" src="js/boutique.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="images/boutiqueIcon.ico" /> 
  <link rel="stylesheet" type="text/css" href="css/cssPrincipal.php" />
  <link rel="alternate" type="application/rss+XML" title="rss de maBoutiquePerso" href="xml/rss.xml" />
  <title>Ma Boutique Personnelle</title>
  </head>
  <body>
  
    <!-- calque principal -->
    <div id="divPrincipal">

      <!-- zone de titre -->
      <div id="divTitre" class="petitTexte">
        <?php echo date("d/M/Y") ?>
      </div>
      
      <!-- zone du menu -->      
      <div id="divMenus">
        |<?php espace(2) ?><a href="index.php">accueil</a><?php espace(2) ?>|<?php espace() ?>
        <a href="tshirt.php">t-shirt personnalisé</a><?php espace(2) ?>|<?php espace() ?>
        <a href="boutique.php">boutique</a><?php espace(2) ?>|<?php espace() ?>
        <a href="panier.php">votre panier</a><?php espace(2) ?>|<?php espace() ?>
        <a href="perso.php">votre espace perso</a><?php espace(2) ?>|<?php espace(3) ?>|<?php espace() ?>
        <a href="mailto:test@free.fr">contact</a><?php espace(2) ?>|
      </div>
