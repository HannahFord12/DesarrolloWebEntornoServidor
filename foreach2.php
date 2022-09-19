<?php
$colores = array('blanco'=>'blanco.html', 'verde' => 'verde.html', 'rojo' => 'rojo.html');
echo "<ul>";
foreach ($colores as $index  => $color) {
    echo "<li> <a $color > $index </a></li> ";
};
echo "<ul>";
?>