<?php

namespace Controllers;
use MVC\Router;

class PropiedadController{
    // public static function index(Router $router){
        public static function index(Router $router){
        // debugear($router);
        $router->mostrarVista("propiedades/admin", [ 
            "mensaje" => "LO que me mataaa es cuando te pones bellacaa yieee"]);

    }

    public static function crear(){
        echo "crear propiedad";
    }

    public static function actualizar(){
        echo "actualizar propiedad";
    }
}

?>