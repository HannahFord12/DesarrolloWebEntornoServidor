<?php 
$nombre = $_GET['nombre'] ?? 'David';
echo trim($nombre , '/');
?>