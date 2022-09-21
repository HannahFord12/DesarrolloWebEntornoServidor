<?php
    $palabras = ["hola", "dos","perro","gato","matematicas"];
    $resultado = array_map("strlen",$palabras);
    $valorMaximo = max($resultado);
    $valorMinimo = min($resultado);
    echo "La longitud de la palabra mas larga es: $valorMaximo y la del valor minimo: $valorMinimo"; 
?>