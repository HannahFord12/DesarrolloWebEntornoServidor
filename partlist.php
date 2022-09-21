<?php
    $palabras = ["Seguro", "que" , "apruebo", "esta", "asignatura"];

    for ($i=0; $i < (count($palabras)-1); $i++) { 
        $resultado[$i]= array_slice($palabras,$i+1,count($palabras));
        $resultado[$i] = array_slice($palabras,$i+1);
    };
    print_r($resultado);
?>