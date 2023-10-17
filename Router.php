<?php

namespace MVC;

class Router {

    public $rutasGet=[];
    public $rutasPost=[];

    public function get( string $url, array $funcion){
        $this->rutasGet[$url] = $funcion;
        // echo "la url es " . $url;echo '<br>';
        // echo '<pre>';var_dump($funcion);echo '</pre>';
    }

    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];
        // debugear($urlActual);
        if($metodo === "GET"){
            $funcion = $this->rutasGet[$urlActual] ?? null;
            // debugear($this->rutasGet);
        }


        if($funcion){
            // La url existe y hay una funcion asociada

            // echo "funcion: "; echo '<pre>';var_dump($funcion);echo '</pre>';
            // echo "EL objeto this"; echo '<pre>';var_dump($this);echo '</pre>';echo '<br>';
            call_user_func($funcion, $this);
            // call_user_func(callable, parametros opcionales)
            //callable -> Puede ser el nombre de la función como una cadena, un array con un objeto y un nombre de método, o una función anónima.
            // Parámetros opcionales que se pueden pasar a la función que se va a llamar.
        }else{
            debugear("error 404");
        }
    }

    // Muestra una vista
    public function mostrarVista($view) {
        include __DIR__ . "/views/$view.php";
    }
}