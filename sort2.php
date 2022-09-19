<?php
$cadenaTemperatura = $_GET['temperaturas'] ?? '10 25 20 30 20 14 18 26 25 25 14 18';
$temperaturas = explode(" ", $cadenaTemperatura);
// hacer la media de las temperaturas
$nMediciones = count($temperaturas);
$sumaTemperaturas = 0;
foreach ($temperaturas as $key => $temperatura) {
    $sumaTemperaturas += $temperatura;
};
$resultado = $sumaTemperaturas / $nMediciones;
echo "La media de las temperaturas es : $resultado<br>";
// imprimir las dos temperaturas mas altas
arsort($temperaturas);
echo "Las temperaturas mas altas del registro han sido: <br>";
print_r(array_slice($temperaturas,0,4));
echo "<br>";
//imprimir temperaturas bajas
asort($temperaturas);
echo "Las temperaturas mas bajas del registro han sido: <br>";
$temperaturasMenores = array_slice($temperaturas,0, 4);
print_r($temperaturasMenores);
?>