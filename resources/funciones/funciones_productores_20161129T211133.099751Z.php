<?php

include("conectaBBDD.php");


function select_productores(){
    include("config.php");

    try {

        $conn = new PDO('mysql:host='.$host.';dbname=' . $bd, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        print "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
        print "  <p>Error: " . $e->getMessage() . "</p>\n";
        exit();

    }
    $sql = "SELECT * FROM productores";
    $statement = $conn ->prepare($sql);
    $statement->execute();
    $devuelve_select = " ";
    $devuelve_select.= "<option value=\"nulos\"></option>";
    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {

        $devuelve_select.= "<option value=".$fila['ID_PRODUCTOR'].">".$fila['NOM_PRODUCTOR']."</option>";
    }



    return $devuelve_select;
    
};

function consultar_productores($sql){
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

    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {
        $ref=$fila['ID_PRODUCTOR'];
        $devuelve_select.= "<tbody><tr><td>".$fila['NOM_PRODUCTOR']."</td><td>".$fila['CIF_PRODUCTOR']."</td>
        <td>".$fila['DIR_PRODUCTOR']."</td><td>".$fila['POB_PRODUCTOR']."</td><td>".$fila['TEL_PRODUCTOR']."</td><td>".$fila['CORREO_PRODUCTOR']."</td>
        <td><a href='modificar_productor.php?ref=$ref'><img src='../img/edit.png'></a></td>
        <td><a href='borrar_productor.php?ref=$ref'><img src='../img/basket.png'></a></td></tr></tbody>";
    }



    return $devuelve_select;

};
/*---------------- Comprobar si el codigo ya esta introducido en el sistema --------------------*/
function comprueba_id($sql){
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
    $filas = $statement ->rowCount();


    return $filas;

};

function alta_productor($sql){
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

function consultar_productores_insertados($sql){
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
    $devuelve_select .= " <h3 align='center'> Los datos han sido insertados correctamente.</h3>";
    $devuelve_select .= "<br>";
    $devuelve_select .= "<table class='tabla_muestra_productor'>
                        <thead><td>id_Productor</td><td>Nombre</td><td>CIF</td><td>Dirección</td><td>Población</td><td>Teléfono</td>
                        <td>Email</td></thead>";

    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {
        $devuelve_select.= "<tr><td>".$fila['ID_PRODUCTOR']."</td><td>".$fila['NOM_PRODUCTOR']."</td><td>".$fila['CIF_PRODUCTOR']."</td>
        <td>".$fila['DIR_PRODUCTOR']."</td><td>".$fila['POB_PRODUCTOR']."</td><td>".$fila['TEL_PRODUCTOR']."</td><td>".$fila['CORREO_PRODUCTOR']."</td>
        </tr>";
    }

    $devuelve_select.= "</table>";

    return $devuelve_select;

};