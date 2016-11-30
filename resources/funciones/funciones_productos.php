<?php

/*----------- include para la conexión con la BD -----------------*/
include("conectaBBDD.php");
/*----------- include para la conexión con la BD -----------------*/
function select_producto_familia(){
    include("config.php");
    try {

        $conn = new PDO('mysql:host='.$host.';dbname=' . $bd, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        print "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
        print "  <p>Error: " . $e->getMessage() . "</p>\n";
        exit();

    }
    $sql = "SELECT DISTINCT FAMILIA_PRODUCTO FROM productos";
    $statement = $conn ->prepare($sql);
    $statement->execute();

    $select_producto_familia = " ";
    $select_producto_familia.= "<option value=\"nulos\"></option>";
    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {

        $select_producto_familia.= "<option value=".$fila['FAMILIA_PRODUCTO'].">".$fila['FAMILIA_PRODUCTO']."</option>";
    }



    return $select_producto_familia;

};

function select_producto_tipo(){
    include("config.php");

    try {

        $conn = new PDO('mysql:host='.$host.';dbname=' . $bd, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        print "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
        print "  <p>Error: " . $e->getMessage() . "</p>\n";
        exit();

    }
    $sql = "SELECT DISTINCT TIPO_PRODUCTO FROM productos";
    $statement = $conn ->prepare($sql);
    $statement->execute();

    $devuelve_select_tipo = " ";
    $devuelve_select_tipo.= "<option value=\"nulos\"></option>";
    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {

        $devuelve_select_tipo.= "<option value=".$fila['TIPO_PRODUCTO'].">".$fila['TIPO_PRODUCTO']."</option>";
    }



    return $devuelve_select_tipo;

};
function consultar_productos_total(){
    include("config.php");
     $sql= "SELECT * FROM productos";           
                            
    try {

        $conn = new PDO('mysql:host='.$host.';dbname=' . $bd, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        print "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
        print "  <p>Error: " . $e->getMessage() . "</p>\n";
        exit();

    }

    if (isset($_GET['pagina'])){

         if ($_GET['pagina']==0){

            header("Location:consulta_producto.php");
        } else {

            $pagina=$_GET['pagina'];

        }

    } else {

         $pagina=1;
         
    }

    $tamano_paginas=9;
    $empezar_desde = ($pagina-1)*$tamano_paginas;
    $statement = $conn ->prepare($sql);
    $statement->execute();
    $num_filas=$statement->rowCount();
    $total_paginas=ceil($num_filas/$tamano_paginas);
    $devuelve_select = " ";
    $devuelve_select .=   "Nmero de registros de la consulta " . $num_filas . "<br>";
    $devuelve_select .=   "Mostramos  " . $tamano_paginas . " registros por pagina <br>";
    $devuelve_select .=   "Mostrando la pagina " . $pagina . " de " .$total_paginas."<br>";
    $devuelve_select .= "<br>";
    $devuelve_select .= "<br>";
    $sql_limite = "SELECT * FROM productos LIMIT $empezar_desde, $tamano_paginas";
    $statement = $conn ->prepare($sql_limite);
    $statement->execute();
    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {
        $ref=$fila['ID_PRODUCTO'];
        $devuelve_select.= "<tr><td>".$fila['ID_PRODUCTO']."</td><td>".$fila['TIPO_PRODUCTO']."</td><td>".$fila['NOM_COMERCIAL_PRODUCTO']."</td>
        <td>".$fila['KG_STOCK_PRODUCTO']." Kg</td><td>".$fila['PVP_KG_STOCK']." &#8364/Kg </td>
        <td><a href='modificar_producto.php?ref=$ref'> <img src='../img/edit.png'></a></td>
        <td><a href='borrar_producto.php?ref=$ref'><img src='../img/basket.png'></a></td></tr>";
    }

    /*------------- Paginacion  -----------------------*/
     $devuelve_select .= "<tr><td colspan=7> Número de paginas de consulta: ";
    for ($i=1; $i<=$total_paginas;$i++){

         $devuelve_select .= "<a class='enlaces' href='?pagina=". $i . "'>". $i . "</a>   ";


    }
    $devuelve_select .= "</td></tr>";
    return $devuelve_select;

};

function consultar_productos($sql){
    include("config.php");

    try {

        $conn = new PDO('mysql:host='.$host.';dbname=' . $bd, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        print "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
        print "  <p>Error: " . $e->getMessage() . "</p>\n";
        exit();

    }

    $tamano_paginas=7;
    $pagina=1;
    $empezar_desde = ($pagina-1)*$tamano_paginas;
    $statement = $conn ->prepare($sql);
    $statement->execute();
    $num_filas=$statement->rowCount();
    $total_paginas=ceil($num_filas/$tamano_paginas);
    $devuelve_select = " ";
    $devuelve_select .=   "Número de registros de la consulta " . $num_filas . "<br>";
    $devuelve_select .=   "Mostramos  " . $tamano_paginas . " registros por pagina <br>";
    $devuelve_select .=   "Mostrando la pagina " . $pagina . " de " .$total_paginas."<br>";
    $devuelve_select .= "<br>";
    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {
        $ref=$fila['ID_PRODUCTO'];
        $devuelve_select.= "<tr><td>".$fila['ID_PRODUCTO']."</td><td>".$fila['TIPO_PRODUCTO']."</td><td>".$fila['NOM_COMERCIAL_PRODUCTO']."</td>
        <td>".$fila['KG_STOCK_PRODUCTO']." Kg</td><td>".$fila['PVP_KG_STOCK']." &#8364/Kg </td>
        <td><a href='modificar_producto.php?ref=$ref'> <img src='../img/edit.png'></a></td>
        <td><a href='borrar_producto.php?ref=$ref'><img src='../img/basket.png'></a></td></tr>";
    }


    $devuelve_select .= "<tr><td colspan=7>";
    for ($i=1; $i<=$total_paginas;$i++){

         $devuelve_select .= "<a href='?pagina=". $i . "'>". $i . "</a>   ";


    }
    $devuelve_select .= "</td></tr>";
    return $devuelve_select;


};


function alta_productos($sql){
    include("config.php");
    try {

        $conn = new PDO('mysql:host='.$host.';dbname=' . $bd, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        print "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
        print "  <p>Error: " . $e->getMessage() . "</p>\n";
        exit();

    }

    $statement = $conn ->prepare($sql);
    $statement->execute();

}

function consultar_productos_insertados($sql){
    include("config.php");


    try {

        $conn = new PDO('mysql:host='.$host.';dbname=' . $bd, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        print "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
        print "  <p>Error: " . $e->getMessage() . "</p>\n";
        exit();

    }

    $statement = $conn ->prepare($sql);
    $statement->execute();
    $devuelve_select = " ";
    $devuelve_select .= " <h3 align='center'> Los datos han sido insertados correctamente.</h3>\n\n";
    $devuelve_select .= "<table class='tabla_muestra_productor'>
                        <thead><td>Categoría</td><td>Tipo</td><td>Nombre</td><td>Kg Stock </td><td>Pvp Kg</td><td>Productor</td>
                        </thead>";

    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {
        $devuelve_select.= "<tr><td>".$fila['FAMILIA_PRODUCTO']."</td><td>".$fila['TIPO_PRODUCTO']."</td>
        <td>".$fila['NOM_COMERCIAL_PRODUCTO']."</td><td>".$fila['KG_STOCK_PRODUCTO']."</td><td>".$fila['PVP_KG_STOCK']."</td><td>".$fila['ID_PRODUCTOR']."</td>
        </tr>";
    }

    $devuelve_select.= "</table>";

    return $devuelve_select;

};
