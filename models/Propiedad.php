<?php

namespace Model;

class Propiedad extends PrincipalActiveRecord{
    
    
    protected static $tabla = 'propiedades';
    protected static $columnasBD = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorId'];
    
    
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date("Y/m/d");
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar(){
        if(!$this->titulo)
            self::$errores[]  = 'Debes añadir un titulo';

        if(!$this->precio)
            self::$errores[] = 'El precio es obligatorio';

        if(strlen ($this->descripcion) <50)
            self::$errores[] = 'Debes añadir una descripcion con minimo 50 caracteres';           

        if(!$this->habitaciones)
            self::$errores[]  = 'El numero de habitaciones es obligatorio';

        if(!$this->wc)
            self::$errores[]  = 'El numero de baños es obligatorio';       

        if(!$this->estacionamiento)
            self::$errores[]  = 'El numero de estacionamientos es obligatorio';    

        if(!$this->vendedorId)
            self::$errores[]  = 'Elige un vendedor'; 
            
        if(!$this->imagen){
            self::$errores[] = 'La imagen es obligatoria';
        }

        // if(!$this->imagen['name'])        
        //     self::$errores[]  = 'La imagen es obligatoria'; 
        // //validar por tamaño de la imagen 100kb
        // $medida = 10000 * 100;

        // if($this->imagen['size']> $medida)    
        //     self::$errores[] = 'La imagen no puede superar los 1000 MegaBytes';
        return self::$errores;
    }

}

?>