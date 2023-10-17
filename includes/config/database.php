<?php


function conectarDb() : mysqli{
    //mysqli conectado de forma orientada a objetos
    $hostnanme='localhost';
    $usuername ="root";
    $password = "root";
    $database = "bienesraices_crud";
    $db = new mysqli( $hostnanme, $usuername, $password, $database);
    if(!$db){
        echo "error, no se pudo conectar";
        exit;
    }
    return $db;
}

//Manera poco segura
function conectarDb2() : mysqli{
    //Manera poco segura
    $db = mysqli_connect('localhost','root','root','bienesraices_crud');
    if(!$db){
        echo "error, no se pudo conectar";
        exit;
    }

    return $db;
}
?>