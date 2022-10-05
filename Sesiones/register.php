<?php
session_start();
if (isset($_SERVER['username'])){
    echo "Ya estas logeado no hace falta registrarse!!";
}
function existe($nombre, $email) 
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE username = '$nombre' AND email = '$email'";
    return $pdo->query($sql)->fetch();
}
function registro($nombre, $email, $password) 
{
    global $pdo;
    $pdoSt = $pdo->prepare('INSERT INTO users (username,email,clave) VALUES (?, ?, ?)');
    $pdoSt -> bindParam(1,$nombre);
    $pdoSt -> bindParam(2,$email);
    $pdoSt -> bindParam(3,$password);
    $pdoSt -> execute();
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
    // El email es obligatorio y ha de tener formato adecuado
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || empty($_POST["email"])){
        $errores[] = "No se ha indicado email o el formato no es correcto";
    }
    if(empty($_POST['password']) || strlen($_POST['password']) > 5){
        $errores[]="La contraseña es requerida y ha de ser mayor a 5 caracteres";
    }
    if(!($_POST['password'] == $_POST['confirmPassword'])){
        $errores[]="Las contraseñas no coinciden";
    }
    if(empty($errores)){
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $existe = existe($nombre,$email);
        if(!$existe){
            registro($nombre,$email,$password);
            $_SESSION['username'] = $nombre;
            $_SESSION['succes'] = "Ahora estas logeado";
            unset($_SESSION['msg']);
            header('location: login.php');
        }else {
            echo "El usuario ya existe, prueba con otro";
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
    <form action="" method="post" enctype="multipart/form-data">
        Nombre: <input type="text" name="nombre"><br>
        Email: <input type="email" name="email"><br>
        Contraseña: <input type="password" name="password"><br>
        Confirmar contraseña: <input type="password" name="confirmPassword"><br>
        <input type="submit" name="submit" value="Enviar">
    </form>
       
</body>
</html>