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
        <?php include_once("..//resources/estructura/datoslogin.php");
        include_once("..//resources/funciones/conectaBBDD.php")?>
        <header>
            <?php include_once("..//resources/estructura/header.php")?>
        </header>
        <section>
            <?php include_once("..//resources/estructura/menu_lateral.php")?>
        </section>
        <article>
            <?php include_once("..//resources/funciones/funciones_productores.php");
            include_once("..//resources/funciones/funciones_productos.php");
            include_once("..//resources/funciones/provincias.php");
            include_once("..//resources/funciones/modificar.php");
            include_once("..//resources/funciones/eliminar.php");
            $select_productor = '"'.$_GET['ref'].'"';
            $sql = "SELECT * FROM productores WHERE ID_PRODUCTOR= $select_productor";
            $datos=consultar_productores_modificar($sql);

            ?>


            <section id="consulta_productor">
                <br>

                <h2 align="center"> - Modificación de productor - </h2>
                <br>
                <table id="tablaformu">
                    <form name="alta_productores" class="formu" method="post" action="#">
                        <tr>
                            <td><label>Código:</label></td>
                            <td><input type="text" name="id_productor" id="id_productor" value="<?php echo $datos['ID_PRODUCTOR']; ?>"disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Nombre:</label></td>
                            <td><input type="text" name="nom_productor" id="nom_productor"value="<?php echo $datos['NOM_PRODUCTOR']; ?>"disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>CIF:</label></td>
                            <td><input type="text" name="cif_productor" id="cif_productor"value="<?php echo $datos['CIF_PRODUCTOR']; ?>"disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Dirección:</label></td>
                            <td><input type="text" name="dir_productor" id="dir_productor"value="<?php echo $datos['DIR_PRODUCTOR']; ?>"disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Provincia:</label></td>
                            <td><select name="prov_productor" id="prov_productor"disabled>
                                    <option value="<?php echo $datos['POB_PRODUCTOR']?>"><?php echo $datos['POB_PRODUCTOR']?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Teléfono:</label></td>
                            <td><input type="text" name="tel_productor" id="tel_productor" value="<?php echo $datos['TEL_PRODUCTOR']; ?>"disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Correo Electrónico</label>:</label></td>
                            <td><input type="text" name="email_productor" id="email_productor" value="<?php echo $datos['CORREO_PRODUCTOR']; ?>"disabled>
                            </td>
                        </tr>
                        <tr>
                        <td></td>
                            <td><button id="Consultar" name="eliminar" >Confirmar</button>
                            <a href="menu.php"><button id="cancelar" name="cancelar">Cancelar </button></a></td>
                        </tr>
                    </form>
                </table>
                <?php if(isset($_POST['eliminar'])) {
                    $id='"'.$_GET['ref'].'"';
                    $sql= "DELETE FROM `productores` WHERE ID_PRODUCTOR=$id;";
                    $total = eliminar_productos($sql);
                    if($total!=0){
                        echo "<h2 align='center'> Se ha eliminado " . $total . " un registro de manera exitosa.</h2>";
                    }
                    else{
                        echo "<h2 align='center'> No ha sido posible eliminar el registro.</h2>";
                    }
                }
                if (isset($_POST['cancelar'])){
                    echo "<script> window.location.href='menu.php'</script>";
                }

                ?>


            </section>
        </article>
        <footer>
            <?php include_once("..//resources/estructura/footer.php")?>
        </footer>
    </div>
    <script src="/primer_trimestre/js/ecohuerta.js"></script>
    </body>
    </html>
