<?php

namespace Controllers;
use Model\Vendedor;
use MVC\Router;

class VendedorController {

    public static function crear(Router $router){
        
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor();

        $router->mostrarVista("vendedores/crear",[
            "errores" => $errores,
            "vendedor" => $vendedor
        ]);
    }

    public static function actualizar()  {
    echo "actualizar";
    }

    public static function eliminar()  {
        echo "eliminar";
    }
}

?>