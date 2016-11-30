<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link rel="stylesheet" href="./css/main2.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <title>Ecohuerta</title>
</head>
<body>
<div class="login__container">
    <div class="login__top">
        <img src="img/logo_login.png">
    </div>

    <form class="login__form" method="post" action="#">
        <input type="text" placeholder="Usuario" name="Usuario" autofocus autocomplete="off">
        <input type="password" placeholder=" Contraseña" name="Password" autocomplete="off">
        <input name="Acceder" type="submit" value="ACCEDER">
    </form>
</div>
</body>
</html>

<?php

/*-------------------  Include para la BBDD ---------------------------*/
require_once("./resources/funciones/conectaBBDD.php");
$stringSQL = " ";
$user = " ";
$pass = " ";
$num_filas = 0;

/*-------------------  Valida la introducción de los datos y hace conexion ---------------------------*/

if (isset($_POST['Acceder'])) {
    if ((trim($_POST['Usuario']) === '') || (trim($_POST['Password']) === '')) {

        echo '<script> alert("Por favor, debe de rellenar el usuario y la contraseña para acceder.")</script>';
    } else {
        $user = $_POST['Usuario'];
        $pass = $_POST['Password'];
        $stringSQL = ("SELECT * FROM login WHERE usuario = '$user' AND password = '$pass'");
        $statement = $conn->prepare($stringSQL);
        $statement->execute();
        $num_filas = $statement->rowCount();
        $fila = $statement->fetch(PDO::FETCH_ASSOC);
        compruebaConexion($num_filas, $fila);
    }
}

/*-------------------  Valida la introducción de los datos y hace conexion ---------------------------*/

function compruebaConexion($num_filas, $fila)
{
    if ($num_filas != 0) {
        /*-------------------  Crea la sesión y una cookie ---------------------------*/
        session_start();
        $_SESSION["status"] = $fila['Privilegios'];
        $_SESSION["Usuario"] = "Bienvenido " . $fila['Nombre'] . " " . $fila['Apellidos'];
        header('Location: php/menu.php');

    } else {

        echo '<script> alert("Usuario y/o contraseña incorrecta.")</script>';

    }
}

?>

