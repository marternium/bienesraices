<?php

namespace App;

class Propiedad {
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    protected static $errores = [];

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
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar() {

        $datos = $this->sanitizarDatos();

        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, vendedor_id, creado)";
        $query .= "VALUES (";
        $query .= "'{$datos['titulo']}', ";
        $query .= "'{$datos['precio']}', ";
        $query .= "'{$datos['imagen']}', ";
        $query .= "'{$datos['descripcion']}', ";
        $query .= "'{$datos['habitaciones']}', ";
        $query .= "'{$datos['wc']}', ";
        $query .= "'{$datos['estacionamiento']}', ";
        $query .= "'{$datos['vendedorId']}', ";
        $query .= "'{$datos['creado']}'";
        $query .= ")";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function setDB($database) {
        self::$db = $database;
    }

    public function datos(){
        $datos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $datos[$columna] = $this->$columna;
        }
        return $datos;
    }

    public function sanitizarDatos(){
        $datos = $this->datos();
        $sanitizado = [];
        foreach($datos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public static function getErrores() {
        return self::$errores;
    }

    public function setImagen($imagen) {
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function validar(){

        if(!$this->titulo) self::$errores[] = "El titulo es obligatorio";
        if(!$this->precio) self::$errores[] = "El precio es obligatorio";
        if(!$this->imagen) self::$errores[] = "La imagen es obligatoria";
        if(!$this->descripcion) self::$errores[] = "La descripción es obligatoria";
        if(strlen($this->descripcion) < 50) self::$errores[] = "La descripción debe tener al menos 50 caracteres";
        if(!$this->habitaciones) self::$errores[] = "El número de habitaciones es obligatorio";
        if(!$this->wc) self::$errores[] = "El número de baños es obligatorio";
        if(!$this->estacionamiento) self::$errores[] = "El número de estacionamientos es obligatorio";
        if(!$this->vendedorId) self::$errores[] = "El vendedor es obligatorio";

        return self::$errores;
    }

}