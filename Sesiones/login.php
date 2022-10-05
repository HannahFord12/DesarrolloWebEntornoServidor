<?php
session_start();
if (isset($_SESSION["username"])){
    echo "Ya estas logeado";
}
function redirect(){
    header("Location: register.php");
    exit();
}
function inicioSesion($nombre, $password) 
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE username = '$nombre' AND clave = '$password'";
    return $pdo->query($sql)->fetch();
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $opciones = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    );
   
    $pdo = new PDO(
        'mysql:host=localhost;dbname=Sesiones;charset=utf8',
        'root',
        'sa',
    $opciones);
    
    // El nombre y contraseña son campos obligatorios
    if(empty($_POST["nombre"])){
        $errores[] = "El nombre es requerido";
    }  
    if(empty($_POST['password']) || strlen($_POST['password']) > 5){
        $errores[]="La contraseña es requerida y ha de ser mayor a 5 caracteres";
    }
    if(empty($errores)){
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $existe =  inicioSesion($nombre,$password);
        if ($existe){
            $_SESSION['username'] = $nombre;
            $_SESSION['succes'] = "Ahora estas logeado";
            unset($_SESSION['msg']);
            header('location: privado.php');
        }
    }
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
        
    </body>
</html>