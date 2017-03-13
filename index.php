<?php include ("head.php") ; ?>
      
      <!-- bandeau des images -->
      <div id="divBandeau">
        <?php 
          for ($k=0 ; $k<2 ; $k++) {
            echo ('<div id="divImg'.$k.'"></div>') ;
          } 
        ?>

       
      </div>

      <!-- zone d'identification -->
      <div id="divIdent">
        <div id="divTextIdent">
          <div class="petitTitre">déjà client</div><br />
          <div class="petitTexte">
            login : <input id="txtLogin" name="txtLogin" type="text" maxlength="20" size="10" class="petitTexte" /><br />
            mdp : <input id="pwdMdp" name="pwdMdp" type="password" maxlength="20" size="4" class="petitTexte" />
            <input id="cmdOk" type="button" class="petitTexte" size="2" value="ok" />
          </div>
        </div>
        <div id="divTextBienvenu">
          <div class="petitTitre">bienvenue</div><br />
          <div class="petitTexte">
            bonjour <label id="lblLogin"><?php echo $login ?></label><br /><br />
            <a href="#" id="aDeconnecter">se déconnecter</a>
          </div>
        </div>        
      </div>

      <!-- zone des news -->
      <div id="divNews">
        <div id="divImgNews"></div>
        <div id="divTextNews" class="petitTexte">
          <?php
            $lesnews = new XMLReader() ;
            $lesnews->open("xml/rss.xml") ;
            $message = "" ;
            while ($lesnews->read()) {
              if ($lesnews->nodeType==XMLReader::ELEMENT) {
                switch ($lesnews->localName) {
                  case "item" :
                    echo $message ;
                    $message = "" ; 
                    break ;
                  case "title" :
                    $message .= "<strong>".utf8_decode($lesnews->readInnerXML())."</strong><br />"; 
                    break ;
                  case "description" :
                    $message .= utf8_decode($lesnews->readInnerXML())."<br /><br />" ; 
                    break ;
                  case "pubDate" :
                    $message = date_format(date_create($lesnews->readInnerXML()), "d/m/Y").":".$message ;
                    break ;
                }
              }
            }
            echo $message ;
            $lesnews->close() ;
 
          ?>
        </div>
      </div>

      <!-- zone des 4 postits du menu -->
      <div id="divPostits">
        <?php
          $postits = array( "tshirt" => "t-shirt personnalisé", 
                            "boutique" => "boutique",
                            "panier" => "votre panier",
                            "espace perso" => "votre espace perso") ;
          $k = 1 ;
          foreach ($postits as $cle => $valeur) {
            echo '<div id="divPostit'.$k.'" class="divPostit petitTitre">' ;
            echo '<a href="'.$cle.'.php"><img src="images/menu'.$k.'.png" alt="'.$cle.'" /></a> ' ;
            echo $valeur.'</div>' ;
            $k++ ;
          } 
        ?>
      </div>

      <!-- zone des liens vers l'extérieur -->
      <div id="divLiens">
        <div id="divTextLiens">
          <div class="petitTitre">mes liens favoris</div><br />
          <div class="petitTexte">
            <a href="http://www.meteofrance.com">Météo France : les meilleures prévisions</a><br />
            <a href="http://www.horlogeparlante.com">Horloge parlante : soyez à l'heure</a>
          
          </div>
        </div>
      </div>

<?php include ("foot.php") ; ?>