
<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/consulta_productor.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION["Usuario"])) {

    header("Location:../index.php");
}
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
?>
<div id="contenedor">
    <?php include_once("../resources/estructura/datoslogin.php");
    include_once("../resources/funciones/conectaBBDD.php")?>
    <header>
        <?php include_once("../resources/estructura/header.php")?>
    </header>
    <section>
        <?php include_once("../resources/estructura/menu_lateral.php")?>
    </section>
    <article>
        <?php include_once("../resources/funciones/funciones_productores.php")?>
        <?php include_once("../resources/funciones/funciones_productos.php")?>
        <?php include_once("../resources/funciones/funciones_usuarios.php")?>
        <section id="consulta_productor">
            <br>
            <h2 align="center"> - Alta de usuarios - </h2>
            <br>
            <table id="tablaformu">
                <form name="alta_productores" class="formu" method="post" action="#">
                    <tr><td><label>Usuario:</label></td>
                        <td><input type="text" name="usuario" id="usuario">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Contraseña:</label></td>
                        <td><input type="password" name="password" id="password">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nombre:</label></td>
                        <td><input type="text" name="nombre" id="nombre">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Apellidos:</label></td>
                        <td><input type="text" name="apellidos" id="apellidos">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Puesto Organizativo:</label></td>
                        <td><input type="text" name="puesto" id="puesto">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Departamento:</label></td>
                        <td><select name="depart" id="depart">
                                <option value="Administracion">Administración</option>
                                <option value="Economico">Económico</option>
                                <option value="RRHH">Recursos Humanos</option>
                                <option value="Admimistradores">Admimistradores WEB</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Privilegios:</label></td>
                        <td><select name="status" id="status">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                            </select>
                        </td>
                    </tr>
                    <td colspan="2">
                        <input type="submit" value="Grabar" name="inserta_usuario">
                        <input type="reset" value="Borrar">
                    </td>
                    </tr>
                </form>
            </table>
            <br>
            <?php if(isset($_POST['inserta_usuario'])){
                var_dump($_POST);
                if (($_POST['usuario'] === "")||($_POST['password'] === "") ||($_POST['nombre'] === "") ||($_POST['apellidos'] === "")
                    ||($_POST['puesto'] === "") ||($_POST['depart'] === "")||($_POST['status'] === "")){
                    echo "<script>alert ('Por favor, rellenos todos los campos')</script>";
                } else {
                   echo comprobar_insert_usuario();
                }
            }
            ?>

        </section>
    </article>
    <footer>
        <?php include_once("../resources/estructura/footer.php")?>
    </footer>
</div>
<script src="/primer_trimestre/js/ecohuerta.js"></script>
</body>
</html>
<?php
function comprobar_insert_usuario(){
    $info ="";
    $usuario = '"' . $_POST['usuario'] . '"';
    $sql = "SELECT * FROM `login` WHERE `usuario`= $usuario";
    $filas = comprueba_id($sql);
    $info.= ($filas!=0)? "<p>El nombre del usuario ya existe.</p>":"" ;
    $validar_pass=(preg_match('^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',$_POST['password']));
    $info.= ($validar_pass!=0)? "<p>El formato de la contraseña no es correcto.</p>":"" ;
    if ($info===""){
        $usuario=('"'.$_POST['usuario'].'"');$pass=('"'.$_POST['password'].'"');$nombre=('"'.$_POST['nombre'].'"');$ape=('"'.$_POST['apellidos'].'"');$puesto=('"'.$_POST['puesto'].'"');
        $depart=('"'.$_POST['depart'].'"');$status=('"'.$_POST['status'].'"');
        $sql= "INSERT INTO`login`(`usuario`, `password`, `Nombre`,`Apellidos`,`Puesto`,`Departamento`,`Privilegios`)
              VALUES($usuario,$pass,$nombre,$ape,$puesto,$depart,$status)";
        alta_usuario($sql);
        $sql = "SELECT * FROM login WHERE usuario=$usuario";
        $info = consultar_usuarios_insertados($sql);

    } else{
        $info = "<p>Se han producido los siguientes errores.</p>" . $info;
    }
    return $info;
}

?>
