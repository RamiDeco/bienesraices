<?php

namespace App;

class Propiedad extends ActiveRecord
{
    protected static $table = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

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
        $this->vendedorId = $args['vendedorId'] ?? '1';
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }
        if (strlen($this->titulo) > 24) {
            self::$errores[] = "Debes añadir un título más corto";
        }
        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }
        if (strlen($this->precio) > 8) {
            self::$errores[] = "Debes añadir un precio mas bajo";
        }
        if (!$this->descripcion) {
            self::$errores[] = "Debes añadir una descripcion";
        }
        if (strlen($this->descripcion) < 40) {
            self::$errores[] = "Debes añadir una descripcion más larga";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir cantidad de habitaciones";
        }
        if (!$this->wc) {
            self::$errores[] = "Debes añadir cantidad de wc";
        }
        if (!$this->estacionamiento) {
            self::$errores[] = "Debes añadir cantidad de estacionamientos";
        }
        if (!$this->vendedorId) {
            self::$errores[] = "Debes elegir un vendedor";
        }
        if (!$this->imagen) {
            self::$errores[] = "La Imagen es Obligatoria";
        }

        return self::$errores;
    }
}
