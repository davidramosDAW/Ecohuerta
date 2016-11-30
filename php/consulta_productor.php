<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/consulta_productor.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <script>
        function check1() {
            document.getElementById("radio").checked = true;

        }
        function check2() {
            document.getElementById("radio1").checked = true;

        }
    </script>
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
    include_once("..//resources/funciones/conectaBBDD.php") ?>
    <header>
        <?php include_once("..//resources/estructura/header.php") ?>
    </header>
    <section>
        <?php include_once("..//resources/estructura/menu_lateral.php") ?>
    </section>
    <article>
        <?php include_once("..//resources/funciones/funciones_productores.php") ?>
        <section id="consulta_productor">
            <br>
            <h2 align="center"> -  Consulta de Productores - </h2>
            <br>
            <table id="tablaformu">
                <form  name="consulta_productos" class="formu" method="post" action="#">
                    <tr>
                        <td><label >Introduzca una población</label></td>
                        <td><input type="radio" name="buscar" id="radio1" value="poblacion" hidden checked>
                        <input id="poblacion" name="poblacion" type="text" placeholder="Población" onclick="check1()"></td></tr>

                    <tr>
                        <td><label>Seleccione uno de la lista desplegable</label></td>
                        <td><input type="radio" name="buscar" id="radio2" value="productores" hidden>
                            <select id="select_productores" name="select_productores" onclick="check2()" >
                                <?php echo select_productores(); ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button id="Consultar" name="Consultar" >Consultar</button></td>
                    </tr>

                </form>
            </table>
            <br><br><br>

            <?php
        
            
            if (isset($_POST['Consultar'])){
                $flag=validar();  
                realizar_consulta($flag);
            } else {
                 $sql = "SELECT * FROM productores";
            echo "<table class='tabla_muestra_productor'><thead><td>Nombre</td><td>CIF</td><td>Dirección</td><td>Población</td><td>Teléfono</td>
                        <td>Correo Electrónico</td><td>Editar</td><td>Eliminar</td></thead>";
                echo consultar_productores($sql);
                echo "</table>";
            }

           
            ?>
        </section>
    </article>
    <footer>
        <?php include_once("..//resources/estructura/footer.php") ?>
    </footer>
</div>
<script src="../js/ecohuerta.js"></script>
</body>
</html>



<?php

function validar(){
    $flag="";
    if (($_POST['poblacion']==="") && ($_POST['select_productores']==="nulos") ){
        $flag=0;
    } else {
        $flag=1;
    }
    return $flag;
}

function realizar_consulta($flag){

    if ($flag===1)
    {
        switch ($_POST['buscar'])
        {
            case ("poblacion"):
                $select_productor = '"'.$_POST['poblacion'].'"';
                $sql = "SELECT * FROM productores WHERE POB_PRODUCTOR= $select_productor";
                $salida = consultar_productores($sql);
                genera_salida($salida);
                break;

            case ("productores"):
                $select_productor = '"'.$_POST['select_productores'].'"';
                $sql = "SELECT * FROM productores WHERE ID_PRODUCTOR= $select_productor";
                $salida = consultar_productores($sql);
                genera_salida($salida);
                break;

        }
    }else{
        echo "<h3 align='center'> Por favor, rellene los campos para ejecutar la consulta</h3>";
        unset($_POST['Consultar']);
    }}

function genera_salida($salida)
{
    if ($salida != " ") {
        echo "<table class='tabla_muestra_productor'><thead><td>Nombre</td><td>CIF</td><td>Dirección</td><td>Población</td><td>Teléfono</td>
                        <td>Email</td><td>Editar</td><td>Eliminar</td></thead>";
        echo $salida . "</table>";
    } else {
        echo "<h4 align='center'> No existen registros para la consulta ejecutada.</h4>";
    }
}

?>

