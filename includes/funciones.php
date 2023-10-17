<!-- Algunas funciones que vamos a reutilizar en varios templates -->

<?php 

// require 'app.php'; Ya no es necesario, porque desde app.php, estoy mandadndo a llamar este archivo


//constante   define (nombre , valor);
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',  __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');


function incluirTemplate( string $nombre , bool $inicio = false){
    // include "includes/templates/{$nombre}.php";  SI SIRVE, al parece toca desde la raiz del proyeco
    // include "templates/{$nombre}/.php"; NO sirveee
    // echo TEMPLATES_URL . "/{$nombre}.php";
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

?>

