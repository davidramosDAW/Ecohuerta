
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
            <h2 align="center"> - Alta de producto - </h2>
            <br>
            <table id="tablaformu">
                <form name="alta_productores" class="formu" method="post" action="#">
                    <tr>
                        <td><label>Código Producto:</label></td>
                        <td><input type="text" name="id_producto" id="id_producto" placeholder=" Tipo Ej.(F_00X)"> 
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nombre:</label></td>
                        <td><input type="text" name="nom_producto" id="nom_producto">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Productor:</label></td>
                        <td><select id="select_productores" name="select_productores" onclick="check3()">
                            <?php echo select_productores(); ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td><label>Categoría Producto:</label></td>
                        <td><select id="select_producto_familia" name="select_producto_familia" onclick="check4()">
                            <?php echo select_producto_familia(); ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td><label>Tipo Producto:</label></td>
                        <td><select id="select_producto_tipo" name="select_producto_tipo" onclick="check5()">
                            <?php echo select_producto_tipo(); ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td><label>Stock Producto (Kg):</label></td>
                        <td><input type="number" name="stock" id="stock">
                        </td>
                    </tr>
                    <tr>
                        <td><label>PVP </label>:</label></td>
                        <td><input type="float" name="pvp" id="pvp">
                        </td>
                    </tr>
                    <td colspan="2">
                        <input type="submit" value="Grabar" name="inserta_productor">
                        <input type="reset" value="Borrar">
                    </td>
                    </tr>
                </form>
            </table>
            <br>
            <?php if(isset($_POST['inserta_productor'])){
                if (($_POST['id_producto'] === "")||($_POST['nom_producto'] === "") ||($_POST['select_productores'] === "nulos") ||($_POST['select_producto_familia'] === "nulos")
                    ||($_POST['select_producto_tipo'] === "nulos")||($_POST['stock'] === "")||($_POST['pvp'] === "")){
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
    $compruebaid = '"' . $_POST['id_producto'] . '"';
    $sql = "SELECT * FROM `productos` WHERE `ID_PRODUCTO`= $compruebaid";
    $filas = comprueba_id($sql);
    $info.= ($filas!=0)? "<p>El código de productor ya existe en la BBDD.</p>":"" ;
    $id_prod= $_POST['id_producto'];
    $info.= (strlen($id_prod)!=5)? "<p>El código de producto tiene que tener 5 Caracteres .</p>":"" ;
    if ($info===""){
        $id=strtoupper('"'.$_POST['id_producto'].'"');$nom=strtoupper('"'.$_POST['nom_producto'].'"');$productor=strtoupper('"'.$_POST['select_productores'].'"');$familia=strtoupper('"'.$_POST['select_producto_familia'].'"');$tipo=strtoupper('"'.$_POST['select_producto_tipo'].'"');
        $stock=strtoupper($_POST['stock']);$pvp=strtoupper($_POST['pvp']);
        $sql= "INSERT INTO `productos`(`ID_PRODUCTO`, `ID_PRODUCTOR`, `NOM_COMERCIAL_PRODUCTO`, `TIPO_PRODUCTO`, `FAMILIA_PRODUCTO`, `KG_STOCK_PRODUCTO`, `PVP_KG_STOCK`, `IMAGEN_PRODUCTO`)
                VALUES ($id,$productor,$nom,$tipo,$familia,$stock,$pvp,null);";
        alta_productos($sql);
        $sql = "SELECT * FROM productos WHERE ID_PRODUCTO=$id";
        $info = consultar_productos_insertados($sql);

    } else{
        $info = "<h3>Se han producido los siguientes errores.</h3>" . $info;
    }
    return $info;
}

?>