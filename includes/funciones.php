<?php 

//constante   define (nombre , valor);
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',  __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");


function incluirTemplate( string $nombre , bool $inicio = false){
    include   TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado() {
    session_start();

    if(!$_SESSION['login'])
        return header("Location: /");
}


function debugear($variable): void{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

// Escapa / sanitizar html, sanitizar lo que se va imprimir
function s($html){
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenidp 
function validarTipoContenido($tipo){
    $tipos=['propiedad','vendedor'];
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo){
    $mensaje='';
    switch($codigo){
        case 1:
            $mensaje ="Creado Correctamente";
            break;
        case 2:
            $mensaje ="Actualizado Correctamente";
            break;
        case 3:
            $mensaje ="Eliminado Correctamente";
            break;            
        default:
            $mensaje=false;
            break;
    }
    return $mensaje;
}

// Función que valida un parámetro de ID obtenido de la URL y redirecciona si no es un entero válido.
function validarORedireccionar(string $url){
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: $url");
    }
    return $id;
}

?>

