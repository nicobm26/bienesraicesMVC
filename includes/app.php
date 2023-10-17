<?php
// Esta va ser el archivo principal, que se va a encargadar de orquestar y mandan a llmar funciones y clase

require __DIR__ . '/funciones.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base de datos
$db = conectarDb();

use Model\PrincipalActiveRecord;

PrincipalActiveRecord::setDB($db);


?>
