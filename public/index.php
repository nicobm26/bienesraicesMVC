<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../includes/app.php";

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router = new Router();

// Registrando las urls a metodos del controlador
$router->get("/admin", [PropiedadController::class , 'index']);
$router->get("/propiedades/crear", [PropiedadController::class, 'crear']);
$router->post("/propiedades/crear", [PropiedadController::class, 'crear']);
$router->get("/propiedades/actualizar", [PropiedadController::class, 'actualizar']);
$router->post("/propiedades/actualizar", [PropiedadController::class, 'actualizar']);
$router->post("/propiedades/eliminar", [PropiedadController::class, 'eliminar']);


$router->get("/vendedor/crear", [VendedorController::class , 'crear']);
$router->post("/vendedor/crear", [VendedorController::class , 'crear']);
$router->get("/vendedor/actualizar", [VendedorController::class , 'actualizar']);
$router->post("/vendedor/actualizar", [VendedorController::class , 'actualizar']);
$router->post("/vendedor/eliminar", [VendedorController::class , 'eliminar']);


$router->comprobarRutas();

?>