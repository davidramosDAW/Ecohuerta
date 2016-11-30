<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ecohuerta</title>
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
        <?php include_once("..//resources/funciones/funciones_productores.php")?>
        <?php include_once("..//resources/funciones/funciones_productos.php")?>
        <section id="consulta_productor">
            <br>
            <h2 align="center"> - Consulta de Productos - </h2>
            <br>
            <table id="tablaformu">
                <form name="consulta_productos" class="formu" method="post" action="#">
                    <tr>
                        <td><label>Productos por fabricante:</label></td>
                        <td><input type="radio" name="buscar" id="radio3" value="producto_fabricante" hidden>
                            <select id="select_productores" name="select_productores" onclick="check3()">
                                <?php echo select_productores(); ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td><label>Productos por categoría:</label></td>
                        <td><input type="radio" name="buscar" id="radio4" value="producto_categoria" hidden>
                            <select id="select_producto_familia" name="select_producto_familia" onclick="check4()">
                                <?php echo select_producto_familia(); ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td><label>Productos por tipo:</label></td>
                        <td><input type="radio" name="buscar" id="radio5" value="producto_tipo" hidden>
                            <select id="select_producto_tipo" name="select_producto_tipo" onclick="check5()">
                                <?php echo select_producto_tipo(); ?>
                            </select></td>
                    </tr>
                    <tr>

                        <td colspan="2">
                            <button id="Consultar" name="Consultar_producto">Consultar</button>                        
                        </td>
                    </tr>
                </form>
            </table>
            <br>
            <?php
            if (isset($_POST['Consultar_producto'])) {
                if (($_POST['select_productores']==="nulos") && ($_POST['select_producto_familia']==="nulos") && ($_POST['select_producto_tipo']==="nulos")){
                    echo "<h3 align='center'> Por favor, rellene algún campo para ejecutar la búsqueda.</h3>";
                }else {
                    realizar_consulta_productos();
                }
            }else {

                 echo "<table class='tabla_muestra_productor'><thead><td>id_Producto</td><td>Tipo</td><td>Nombre</td><td>Stock</td><td>PVP</td>
                            <td>Editar</td><td>Eliminar</td></thead>";
            echo consultar_productos_total();
            echo"</table>";
            }
            ?>

        </section>
    </article>
    <footer>
        <?php include_once("..//resources/estructura/footer.php");


        ?>

    </footer>
</div>
<script src="/primer_trimestre/js/ecohuerta.js"></script>
</body>
</html>
<?php
function realizar_consulta_productos()
{

    switch ($_POST['buscar']) {

        case ("producto_fabricante"):
            $select_productor = '"' . $_POST['select_productores'] . '"';
            $sql = "SELECT * FROM productos WHERE ID_PRODUCTOR= $select_productor";
            $salida = consultar_productos($sql);
            genera_salida($salida);
            break;

        case ("producto_categoria"):
          
            $producto_categoria = '"' . $_POST['select_producto_familia'] . '"';
            $sql = "SELECT * FROM productos WHERE FAMILIA_PRODUCTO= $producto_categoria";
            $salida = consultar_productos($sql);
            genera_salida($salida);
            break;

        case ("producto_tipo"):
            $producto_tipo = '"' . $_POST['select_producto_tipo'] . '"';
            $sql = "SELECT * FROM `productos` WHERE `TIPO_PRODUCTO`=$producto_tipo";
            $salida = consultar_productos($sql);
            genera_salida($salida);
            break;

    }
}

function genera_salida($salida)
{
    if ($salida != " ") {
        echo "<table class='tabla_muestra_productor'><thead><td>id_Producto</td><td>Tipo</td><td>Nombre</td><td>Stock</td><td>PVP</td>
                            <td>Editar</td><td>Eliminar</td></thead>";
        echo $salida . "</table>";
    } else {
        echo "<h3 align='center'> No existen registros para la consulta ejecutada.</h3>";
    }
}

?>



