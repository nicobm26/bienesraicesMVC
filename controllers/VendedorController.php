<?php

namespace Controllers;
use Model\Vendedor;
use MVC\Router;

class VendedorController {

    public static function crear(Router $router){
        
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $vendedor = new Vendedor($_POST['vendedor']);
            // Validar
            $errores = $vendedor->validar();
            if(empty($errores)){
                $resultado = $vendedor->guardar();
                if($resultado) 
                    header('location: /propiedades');
            }
        }

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