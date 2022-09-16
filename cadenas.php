<?php 
$nombre = $_GET['nombre'] ?? 'David';
$prefijo = $_GET['prefijo'] ?? 'Da';
$nombreFinal = trim($nombre , '/');
echo $nombreFinal;
echo '<br>';
echo "El nombre tiene una longitud de ". strlen($nombreFinal). " caracteres";
echo '<br>';
echo strtoupper($nombreFinal);
echo '<br>';
echo strtolower($nombreFinal);
$valPrefijo = strpos($nombreFinal,$prefijo);
echo '<br>';
if ($valPrefijo !== false){
    echo "El prefijo ". $prefijo . " coincide con ". $nombreFinal;
}else{
    echo "El prefijo ". $prefijo . " no coincide con ". $nombreFinal;
}
echo "<br>";
$letrasMayusculas = substr_count($nombreFinal,'A');
$letrasMinusculas = substr_count($nombreFinal,'a');
echo "Hay $letrasMayusculas letras a mayusculas y $letrasMinusculas letras a minusculas";
echo "<br>";
$posA = stripos(strtolower($nombreFinal),'a');
echo "La primera a esta en la posición: $posA";
echo "<br>";
echo str_ireplace('o','0',$nombreFinal);
echo "<br>";
$url = 'http://username:password@hostname:9090/path?arg=value';
echo $url;
echo "<br>";

$urlseccionado = parse_url($url);
echo "En el url tenemos el siguiente protocolo: $urlseccionado[scheme] , el nombre de usuario: $urlseccionado[user] , el path : $urlseccionado[path] y el querystring de la url : $urlseccionado[query] .";
?>