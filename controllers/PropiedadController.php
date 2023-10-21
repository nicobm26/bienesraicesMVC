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

    public static function actualizar(Router $router){
        
        // Función que valida un parámetro de ID obtenido de la URL y redirecciona si no es un entero válido.
        $id = validarORedireccionar("/admin");

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::findById($id);

        // Consultar para obtener los vendedores
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // debugear($_POST);
            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
            // debugear($propiedad);

            // Validación
            $errores = $propiedad->validar();
     
            //Genera un nombre unico
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";
    
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            
            //revisar que el arreglo de errores este vacio
            if(empty($errores)){
                // Realiza el resize con intervention  Y Setear la imagen
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                $propiedad->guardar();
            }
        }
        
        $router->mostrarVista('propiedades/actualizar',[
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
}

?>