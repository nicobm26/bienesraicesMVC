<?php

require_once __DIR__ . "/../includes/app.php";

use MVC\Router;
use Controllers\PropiedadController;

$router = new Router();

// Registrando las urls a metodos del controlador
$router->get("/admin", [PropiedadController::class , 'index']);
$router->get("/propiedades/crear", [PropiedadController::class, 'crear']);
$router->get("/propiedades/actualizar", [PropiedadController::class, 'actualizar']);

$router->comprobarRutas();

?>