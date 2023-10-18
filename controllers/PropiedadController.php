<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
// use Intervention\Image as Image;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    public static function index(Router $router){

    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    $resultado = $_GET["resultado"] ?? null;

    $router->mostrarVista("propiedades/admin", [ 
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){

        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
            $propiedad = new Propiedad($_POST['propiedad']);
            
            // debugear($_FILES);
            $image = null;
            //Genera un nombre unico
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";

            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
    
            // debugear($_SERVER["DOCUMENT_ROOT"]);
            
            // Validar
            $errores = $propiedad->validar();
            if(empty($errores)){
        
                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }    
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                // Guarda en la base de datos
                $resultado = $propiedad->guardar();

                if($resultado) {
                    header('location: /propiedades');
                }
            }
        }
        
        $router->mostrarVista('propiedades/crear',[
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function actualizar(){
        echo "actualizar propiedad";
    }
}

?>