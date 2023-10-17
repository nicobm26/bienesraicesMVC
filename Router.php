<?php

namespace MVC;

class Router {

    public $rutasGet=[];
    public $rutasPost=[];

    public function get($url, $funcion){
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
            // debugear($funcion);
            echo '<pre>';var_dump($funcion);echo '</pre>';
            echo '<pre>';var_dump($this);echo '</pre>';echo '<br>';
            call_user_func($funcion, $this);
        }else{
            debugear("error 404");
        }
    }
}