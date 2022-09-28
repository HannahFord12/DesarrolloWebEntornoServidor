<?php
    $loged = $_GET['dejameEntrar'];
    if($loged == 1){
        echo"Bienvenido";
    }else{
        header("Location: http://127.0.0.1:8080/Headers/CabeceraDeRespuesta/Ejercicio3/login.php");
        exit();
    }
?>