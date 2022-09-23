<?php
$edades=array("Juan"=>"31","María"=>"41","Andrés"=>"39","Berta"=>"40");
$edadesNombre = $edades;
//ordenar por nombre ascendente
echo "Imprimir array ordenada por nombre ascendente<br>";
ksort($edadesNombre);
print_r($edades);
echo "<br>";
print_r($edadesNombre);
//ordenar por edad ascendente
echo "<br>Imprimir array ordenada por edad ascendente <br>";
asort($edadesNombre);
print_r($edades);
echo "<br>";
print_r($edadesNombre);
//ordenar por nombre descendente
echo "<br>Imprimir array ordenada por nombre descendente <br>";
krsort($edadesNombre);
print_r($edades);
echo "<br>";
print_r($edadesNombre);
// ordenar por edad descendente
echo "<br>Imprimir array ordenada por edad descendente <br>";
arsort($edadesNombre);
print_r($edades);
echo "<br>";
print_r($edadesNombre);
?>