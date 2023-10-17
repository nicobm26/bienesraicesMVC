<?php

namespace Controllers;
use MVC\Router;

class PropiedadController{
    // public static function index(Router $router){
        public static function index(Router $router){
        // debugear($router);
        // echo '<pre>'; var_dump($router);  echo '</pre>';
        $router->mostrarVista("propiedades/admin");
    }

    public static function crear(){
        echo "crear propiedad";
    }

    public static function actualizar(){
        echo "actualizar propiedad";
    }
}

?>