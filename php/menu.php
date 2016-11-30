<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
</head>
<body>
<?php
/*-------------------  Si la sesión no esta establecida te envia al index ---------------------------*/
session_start();
if (!isset($_SESSION["Usuario"])) {

    header("Location:../index.php");
}
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
?>
<div id="contenedor">
    <?php include_once("../resources/estructura/datoslogin.php") ?>
    <header>
        <?php include_once("../resources/estructura/header.php") ?>
    </header>
    <section>
        <?php include_once("../resources/estructura/menu_lateral.php") ?>
    </section>
    <article>
        <br>
        <br>
        <br>
        <h2 align="center">Bienvenido a la pagina de gestión del grupo EcoHuerta</h2>
        <br>
        <br>
        <div class="bordemenu">
            <h3>ACCESO A LOS SISTEMAS</h3>
            <br>
            <h4>El usuario autorizado es responsable de proteger la información, mantener el secreto profesional e
                informar del mal uso de los sistemas de información.
                El acceso no autorizado a este sistema o el uso indebido del mismo está prohibido y es contrario a la
                política de seguridad de la empresa en base a la legislación
                vigente en materia de protección de datos.</h4>
        </div>
        <br>
        <div class="bordemenu">
            <h3>CAMPOS DE TEXTO LIBRE</h3>
            <br>
            <h4>En estos tipos de campos o se debe introducir información que contenga datos de ideología, afiliación
                sindical, religión, creencias, origen racial o étnica, salud
                o vida sexual. Tampoco se deben de incluir los datos de carácter personal relativos a la comisión de
                infracciones penales o administrativas.</h4>
        </div>
    </article>
    <footer>
        <?php include_once("../resources/estructura/footer.php") ?>
    </footer>
</div>
</body>
</html>
