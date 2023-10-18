<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;

class PropiedadController{

    public static function index(Router $router){
    // debugear($router);
    $propiedades = Propiedad::all();
    $resultado = null;
    $router->mostrarVista("propiedades/admin", [ 
        "propiedades" => $propiedades,
        "resultado" => $resultado
    ]);

    }

    public static function crear(){
        echo "crear propiedad";
    }

    public static function actualizar(){
        echo "actualizar propiedad";
    }
}

?>