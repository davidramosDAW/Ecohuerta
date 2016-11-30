<?php

 include("conectaBBDD.php");

function muestra_provincias(){
    include("config.php");

    try {

        $conn = new PDO('mysql:host='.$host.';dbname=' . $bd, $usuario, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    } catch (PDOException $e) {

        print "  <p>Error: No puede conectarse con la base de datos.</p>\n\n";
        print "  <p>Error: " . $e->getMessage() . "</p>\n";
        exit();

    }
    $sql = "SELECT * FROM provincias order by nombre ASC ";
    $statement = $conn ->prepare($sql);
    $statement->execute();
    $devuelve_select = " ";
    $devuelve_select.= "<option value=\"nulos\"></option>";
    while ($fila  = $statement -> fetch(PDO::FETCH_ASSOC))
    {

        $devuelve_select.= "<option value=".$fila['nombre'].">".$fila['nombre']."</option>";

    }



    return $devuelve_select;

};