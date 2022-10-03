<?php
function redirect (){
    header("Location: register.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>
    <p>Iniciar sesion</p>
    <form action="" method="post" enctype="multipart/form-data">
        Nombre: <input type="text" name="nombre"><br>
        Contraseña: <input type="password" name="password"><br>
        <input type="submit" name="submit" value="Enviar">
    </form>
    <button onclick="redirect()">Registrarte</button>
       
</body>
</html>