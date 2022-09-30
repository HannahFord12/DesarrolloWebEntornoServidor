<?php
function filtrado($datos){
    $datos = trim($datos); // Elimina espacios antes y después de los datos
    $datos = stripslashes($datos); // Elimina backslashes 
    $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
    return $datos;
};

if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){

    // El nombre y contraseña son campos obligatorios
    if(empty($_POST["nombre"])){
        $errores[] = "El nombre es requerido";
    }
    // El email es obligatorio y ha de tener formato adecuado
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || empty($_POST["email"])){
        $errores[] = "No se ha indicado email o el formato no es correcto";
    }
    // Si el array $errores está vacío, se aceptan los datos y se asignan a variables
    if(empty($errores)) {
        $nombre = filtrado($_POST["nombre"]);
        $educacion = filtrado($_POST["educacion"]);
        // Utilizamos implode para pasar el array a string
        $email = filtrado($_POST["email"]);
    }
}
$directorioSubida = "img/";
$max_file_size = "51200";
$extensionesValidas = array("jpg", "png", "gif");
if(isset($_POST["submit"]) && isset($_FILES['imagen'])){
    $errores = array();
    $nombreArchivo = $_FILES['imagen']['name'];
    $filesize = $_FILES['imagen']['size'];
    $directorioTemp = $_FILES['imagen']['tmp_name'];
    $tipoArchivo = $_FILES['imagen']['type'];
    $arrayArchivo = pathinfo($nombreArchivo);
    $extension = $arrayArchivo['extension'];
    
    // Comprobamos el tamaño del archivo
    if($filesize > $max_file_size){
        $errores[] = "La imagen debe de tener un tamaño inferior a 50 kb";
    }
    // Desplazamos el archivo si no hay errores
    if(empty($errores)){
        $nombreCompleto = $directorioSubida.$nombreArchivo.".".$extension;
        move_uploaded_file($directorioTemp, $nombreCompleto);
        print "El archivo se ha subido correctamente";
    }
}
?>
<html>
<body>
Hola <?php echo $_POST["nombre"]; ?><br>
Tu email es: <?php echo $_POST["email"]; ?><br>
Educación: <?php echo filtrado($_POST["educacion"]);?><br>
Nombre archivo subido: <?php echo $nombreArchivo;?>
</body>
</html>


