
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
        <?php include_once("../resources/funciones/funciones_productores.php");
        include_once("../resources/funciones/funciones_productos.php");
        include_once("../resources/funciones/provincias.php");
        include_once("../resources/funciones/modificar.php");
        $select_producto = '"'.$_GET['ref'].'"';
        $sql = "SELECT * FROM productos WHERE ID_PRODUCTO= $select_producto";
        $datos=consultar_productores_modificar($sql);
        ?>
        <section id="consulta_productor">
            <br>
            <h2 align="center"> - Modificar Producto- </h2>
            <br>
            <table id="tablaformu">
                <form name="alta_productores" class="formu" method="post" action="#">
                    <tr>
                        <td><label>Código Producto:</label></td>
                        <td><input type="text" name="id_producto" id="id_producto" value="<?php echo $datos['ID_PRODUCTO'] ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nombre:</label></td>
                        <td><input type="text" name="nom_producto" id="nom_producto" value="<?php echo $datos['NOM_COMERCIAL_PRODUCTO'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Productor:</label></td>
                        <td><select id="select_productores" name="select_productores" onclick="check3()">
                                <option value="<?php echo $datos['ID_PRODUCTOR'] ?>"><?php echo $datos['ID_PRODUCTOR'] ?></option>
                                <?php echo select_productores(); ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td><label>Categoría Producto:</label></td>
                        <td><select id="select_producto_familia" name="select_producto_familia" onclick="check4()">
                                <option value="<?php echo $datos['FAMILIA_PRODUCTO'] ?>"><?php echo $datos['FAMILIA_PRODUCTO'] ?></option>
                                <?php echo select_producto_familia(); ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td><label>Tipo Producto:</label></td>
                        <td><select id="select_producto_tipo" name="select_producto_tipo" onclick="check5()">
                                <option value="<?php echo $datos['TIPO_PRODUCTO'] ?>"><?php echo $datos['TIPO_PRODUCTO'] ?></option>
                                <?php echo select_producto_tipo(); ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td><label>Stock Producto (Kg):</label></td>
                        <td><input type="number" name="stock" id="stock" value="<?php echo $datos['KG_STOCK_PRODUCTO'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label>PVP </label>:</label></td>
                        <td><input type="float" name="pvp" id="pvp" value="<?php echo $datos['PVP_KG_STOCK'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    <td><button name="modificar_producto" >Modificar</button>
                        <button id="cancelar" name="cancelar">Cancelar</button></td>
                    </tr>
                </form>
            </table>
            <br>
            <?php if(isset($_POST['modificar_producto'])){
                if (($_POST['nom_producto'] === "") ||($_POST['select_productores'] === "nulos") ||($_POST['select_producto_familia'] === "nulos")
                    ||($_POST['select_producto_tipo'] === "nulos")||($_POST['stock'] === "")||($_POST['pvp'] === "")){
                    echo "<script>alert ('Por favor, rellenos todos los campos')</script>";
                } else {
                    echo comprobar_insert_productores();
                }
            }

                if (isset($_POST['cancelar'])){
                    echo "<script> window.location.href='menu.php'</script>";
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
    $compruebaid = '"' . $_GET['ref'] . '"';
    if ($info===""){
        $nom=strtoupper('"'.$_POST['nom_producto'].'"');$productor=strtoupper('"'.$_POST['select_productores'].'"');$familia=strtoupper('"'.$_POST['select_producto_familia'].'"');$tipo=strtoupper('"'.$_POST['select_producto_tipo'].'"');
        $stock=strtoupper($_POST['stock']);$pvp=strtoupper($_POST['pvp']);
        $sql="UPDATE
              `productos`
               SET
              `ID_PRODUCTOR` = $productor,
              `NOM_COMERCIAL_PRODUCTO` = $nom,
              `TIPO_PRODUCTO` = $tipo,
              `FAMILIA_PRODUCTO` = $familia,
              `KG_STOCK_PRODUCTO` = $stock,
              `PVP_KG_STOCK` = $pvp
               WHERE
              `ID_PRODUCTO`= $compruebaid;";

        alta_productos($sql);
        $sql = "SELECT * FROM productos WHERE ID_PRODUCTO=$compruebaid;";
        $info = consultar_productos_insertados($sql);

    } else{
        $info = "<p>Se han producido los siguientes errores.</p>" . $info;
    }
    return $info;
}

?>