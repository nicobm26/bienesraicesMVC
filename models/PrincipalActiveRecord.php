<?php

namespace Model;

class PrincipalActiveRecord{
    

    protected static $tabla = '';

    // Base de datos
    protected static $bd;
    protected static $columnasBD = [];

    //Errores
    protected static $errores = [];

    // Tener una instancia de la conexion de la base de datos de forma estatica
    public static function setDB($database){
        self::$bd = $database;
    }

    // Validacion
    public  static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    
    public function guardar(){
        if(!is_null($this->id)){
            // Si hay un id, Actualizar
            $this->actualizar();
        }else{
            //crear
            $this->crear();
        }
    }

    //Listar propiedades
    public static function all(){
        /* El static::$atributo, va hereder este metodo (all) y va buscar este atributo($atributo) 
        en la clase en la cual se este heredando, en este ejemplo puede ser Propiedad o Vendedor*/ 
        
        $query = "SELECT * FROM " . static::$tabla;
    
        $resultado= self::consultarSQL($query);
        
        return $resultado;
    }    

    // Obtiene determinado numero de registros
    public static function some($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT $cantidad";
    
        $resultado= self::consultarSQL($query);
        
        return $resultado;
    }

    // Buscar una propiedad por su id
    public static function findById($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";  

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }    

    public function crear(){
        
        // Sanitizar los datos  
        $atributos = $this->sanitizarAtributos();

        $stringColumnas = join(', ', array_keys($atributos));
        $stringValores = join(', ', array_values($atributos));
        // debugear($stringColumnas);

        // insertar en la base de datos
        // $query = "INSERT INTO propiedades ( $stringColumnas ) VALUES ('$stringValores')";
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$bd->query($query);

        if($resultado){
            // redireccionar al usuario cuando se crea exitosamante
            header('Location: /admin?resultado=1');            
        }
        return $resultado;
    }    

    public function actualizar(){
        
        // Sanitizar los datos  
        $atributos = $this->sanitizarAtributos();

        $valores =[];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key = '$value' ";
        }
        $query = join(", ", $valores);
         #insertar en la base de datos
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= "WHERE id = '" . self::$bd->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";

        // debugear($query);

        $resultado = self::$bd -> query($query);
        
        if($resultado){
            header('Location: /admin?resultado=2');
        }
    }



    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$bd->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$bd->query($query);
        if( $resultado){
            $this->borrarImagen();
            header("location: /admin?resultado=3");
        }
    }

    // Metodo para cumplir la metodologia active record
    public static function consultarSQL($query){
        //Consultar
        $resultado = self::$bd->query($query);

        // iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            // $array[] = $registro['titulo'];   un arreglo, pero necesitamos objetos
            $array[] = static::crearObjeto($registro);
        }
   
        // Liberar memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }    

    protected static function crearObjeto(array $registro){
        // Registro es un arreglo asociativo
        $objeto = new static;  ////Antes new self, ahora static, porque crea el objeto de su clase hija
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }    


    // Encargado de iterar sobre columnasDB;
    //Identificar y unir los atributos bd
    //Mapear las columnas con el objeto en memoria que tenemos
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasBD as $columna){
            if ($columna === "id")
                continue;
            // if ($columna === "imagen"){
            //     $nombre = $this->imagen($this->imagen);
            //     $atributos[$columna] = $nombre;
            //     continue;
            // }
            $atributos[$columna] = $this->$columna;
        }   
        // debugear($atributos);
        return $atributos;  //en memoria
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$bd->escape_string($value);
        }
        // debugear($atributos);
        // debugear($sanitizado);
        return $sanitizado;
    }  

    //Sincronizael objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args=[]){
        foreach ($args as $key => $value) {
            if( property_exists($this, $key) && !is_null($value) ){
                $this->$key = $value;
            }   
        }
    }

    //subida de archivos
    public function setImagen($imagen){
        // Eliminar imagen previa
        if(!is_null($this->id)){  
           $this->borrarImagen();
        }
        
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen(){
        // Comprobar si el archivo existe
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo)
            unlink(CARPETA_IMAGENES . $this->imagen);
    }
    


    public function imagen($imagen){
        //Subida de archivos
        //crear una carpeta
        $carpetaImagenes = __DIR__ .'/../imagenes/';

        if(!is_dir($carpetaImagenes))
            mkdir($carpetaImagenes);
            
        //generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";
        
        // debugear($carpetaImagenes . $nombreImagen);
        //subirlas
        move_uploaded_file($imagen['tmp_name'] , $carpetaImagenes . $nombreImagen) ;

        return  $nombreImagen;
    }

}


?>
