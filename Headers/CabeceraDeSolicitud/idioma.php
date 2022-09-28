<?php
   $idioma = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
   echo $idioma;
   echo "<br>";
   if (str_contains($idioma,"es")) {
      echo "Esta pagina esta en español";
   }else if (str_contains($idioma,"en")){
      echo "La pagina esta en ingles";
   }
?>