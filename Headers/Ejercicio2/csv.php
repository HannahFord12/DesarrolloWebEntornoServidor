<?php
    $productos = ["1" => "Producto 1", "2" => "Producto 2", "3" => "Producto 3"];
    $ruta = ".";
    generarCSV($productos,"./archivo.csv",";",'"');

    function generarCSV($array, $ruta, $delimitador, $encapsulador){
        $file_handle = fopen($ruta, 'w');
        fputcsv($file_handle, $array, $delimitador, $encapsulador);
        rewind($file_handle);
        fclose($file_handle);
      }
?>