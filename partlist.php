<?php
    $palabras = ["Seguro", "que" , "apruebo", "esta", "asignatura"];
    $iterator= 0;
    for ($i=0; $i < (count($palabras)-1); $i++) {   
    $resultado[$i][$iterator]= implode(" ", array_slice($palabras,0,$i+1));
    $iterator++;
    $resultado[$i] [$iterator]= implode(" ", array_slice($palabras,$i+1));  
    $iterator++;
    };
    print_r($resultado);
?>
