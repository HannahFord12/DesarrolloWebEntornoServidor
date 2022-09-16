<?php
$nombres = ['Paco','Juan','Maria','Lorena'];
echo count($nombres);
echo "<br>";
echo implode(" , ", $nombres);
echo "<br>";
asort($nombres);
foreach ($nombres as $nombre => $value) {
    echo " ".$value." ";
};
array_reverse($nombres);
echo implode(" , ", $nombres);
?>