
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
        <?php include_once("../resources/funciones/provincias.php")?>
        <section id="consulta_productor">
            <br>
            <table id="tablaformu">
                <tr><td colspan="2" align="center">Alta de usuarios</td></tr>
                <form name="alta_productores" class="formu" method="post" action="#">
                    <tr><td><label>Código:</label></td>
                        <td><input type="text" name="id_productor" id="id_productor">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nombre:</label></td>
                        <td><input type="text" name="nom_productor" id="nom_productor">
                        </td>
                    </tr>
                    <tr>
                        <td><label>CIF:</label></td>
                        <td><input type="text" name="cif_productor" id="cif_productor">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Dirección:</label></td>
                        <td><input type="text" name="dir_productor" id="dir_productor">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Provincia:</label></td>
                        <td><select name="prov_productor" id="prov_productor">
                                <?php echo muestra_provincias();?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Teléfono:</label></td>
                        <td><input type="text" name="tel_productor" id="tel_productor">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Correo Electrónico</label>:</label></td>
                        <td><input type="text" name="email_productor" id="email_productor">
                        </td>
                    </tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Grabar" name="inserta_productor">
                        <input type="reset" value="Borrar">
                    </td>
                    </tr>
                </form>
            </table>
            <br>
            <?php if(isset($_POST['inserta_productor'])){
                if (($_POST['id_productor'] === "")||($_POST['nom_productor'] === "") ||($_POST['cif_productor'] === "") ||($_POST['dir_productor'] === "")
                    ||($_POST['prov_productor'] === "nulos")||($_POST['tel_productor'] === "")){
                    echo "<script>alert ('Por favor, rellenos todos los campos')</script>";
                } else {
                    echo comprobar_insert_productores();
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
function comprobar_insert_productores(){
    $info ="";
    $compruebaid = '"' . $_POST['id_productor'] . '"';
    $sql = "SELECT * FROM `productores` WHERE `ID_PRODUCTOR`= $compruebaid";
    $filas = comprueba_id($sql);
    $info.= ($filas!=0)? "<p>El código de productor ya existe en la BBDD.</p>":"" ;
    $patron_tel="/[^0-9]/";
    $tel= $_POST['tel_productor'];
    $validar_tel = preg_match($patron_tel,$_POST['tel_productor']);
    $info.= ($validar_tel!=0)? "<p>El formato del teléfono introducido no es correcto.</p>":"" ;
    $email = $_POST['email_productor'];
    $info.= (filter_var($email, FILTER_VALIDATE_EMAIL))? "":"Esta dirección de correo ($email)  no es válida.";
    if ($info===""){
        $id=strtoupper('"'.$_POST['id_productor'].'"');$nom=strtoupper('"'.$_POST['nom_productor'].'"');$cif=strtoupper('"'.$_POST['cif_productor'].'"');$dir=strtoupper('"'.$_POST['dir_productor'].'"');$prov=strtoupper('"'.$_POST['prov_productor'].'"');
        $tel=strtoupper('"'.$_POST['tel_productor'].'"');$email=strtoupper('"'.$_POST['email_productor'].'"');
        $sql= "INSERT INTO `productores`(`ID_PRODUCTOR`, `NOM_PRODUCTOR`, `CIF_PRODUCTOR`, `DIR_PRODUCTOR`, `POB_PRODUCTOR`, `TEL_PRODUCTOR`, `CORREO_PRODUCTOR`) VALUES ($id,$nom,$cif,$dir,$prov,$tel,$email);";
        alta_productor($sql);
        $sql = "SELECT * FROM productores WHERE ID_PRODUCTOR=$id";
        $info = consultar_productores_insertados($sql);

    } else{
        $info = "<p>Se han producido los siguientes errores.</p>" . $info;
    }
    return $info;
}

?>
