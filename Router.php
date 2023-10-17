<?php

namespace MVC;

class Router {

    public $rutasGet=[];
    public $rutasPost=[];

    public function get($url, $funcion){
        $this->rutasGet[$url] = $funcion;
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
            debugear($funcion);
            call_user_func($funcion, $this);
        }else{
            debugear("error 404");
        }
    }
}