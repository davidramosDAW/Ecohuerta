<?php
if (!isset($_SESSION["Usuario"])) {

    header("Location:../index.php");
}
echo'
 <link rel="stylesheet" href="../css/layout.css">
<article>
        <H3>PARTE DE CONSULTAS</H3>
    </article>
        
 '?>