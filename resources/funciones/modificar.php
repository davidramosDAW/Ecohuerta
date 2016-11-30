<?php

function consultar_productores_modificar($sql){
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

    $fila  = $statement -> fetch(PDO::FETCH_ASSOC);

    return $fila;


};