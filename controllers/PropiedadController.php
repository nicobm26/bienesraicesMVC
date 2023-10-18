<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

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

    public static function crear(Router $router){

        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            debugear($_POST);
        }
        
        $router->mostrarVista('propiedades/crear',[
            "propiedad" => $propiedad,
            "vendedores" => $vendedores
        ]);
    }

    public static function actualizar(){
        echo "actualizar propiedad";
    }
}

?>