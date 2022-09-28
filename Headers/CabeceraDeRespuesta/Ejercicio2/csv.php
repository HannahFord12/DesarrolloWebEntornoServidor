<?php
  header("Content-Type: text/csv");
  header('Content-Disposition: attachment; filename="productos.csv"');
    $productos = ["1" => "Producto 1", "2" => "Producto 2", "3" => "Producto 3"];
    generarCSV($productos);
    

    function generarCSV($array){
      foreach ($array as $index => $producto) {
        echo "$index;$producto\n";
      }
    }
?>