<?php

namespace App;

class Propiedad
{
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

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

    public static function setDB($db):void
    {
        self::$db = $db;
    }

    public function setAtributes():array
    {
        $attr = [];
        foreach (self::$columnasDB as $column) {
            if ($column == 'id') continue;
            if ($column == 'vendedores_id') {
                $attr['vendedores_id'] = $this->vendedorId;
            } else {
                $attr[$column] = $this->$column;
            }
        }

        return $attr;
    }

    public function sanitizeAtts():array
    {
        $attr = $this->setAtributes();
        $sanitizedAtts = [];
        foreach ($attr as $key => $value) {
            $sanitizedAtts[$key] = self::$db->real_escape_string($value);
        }

        return $sanitizedAtts;
    }

    public function setImage($imagen):void
    {
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function validar():array
    {
        $errores = [];

        if (!$this->titulo) {
            $errores[] = "Debes añadir un título";
        }
        if (strlen($this->titulo) > 24) {
            $errores[] = "Debes añadir un título más corto";
        }
        if (!$this->precio) {
            $errores[] = "Debes añadir un precio";
        }
        if (!$this->descripcion) {
            $errores[] = "Debes añadir una descripcion";
        }
        if (strlen($this->descripcion) < 40) {
            $errores[] = "Debes añadir una descripcion más larga";
        }
        if (!$this->habitaciones) {
            $errores[] = "Debes añadir cantidad de habitaciones";
        }
        if (!$this->wc) {
            $errores[] = "Debes añadir cantidad de wc";
        }
        if (!$this->estacionamiento) {
            $errores[] = "Debes añadir cantidad de estacionamientos";
        }
        if (!$this->vendedorId) {
            $errores[] = "Debes elegir un vendedor";
        }
        if (!$this->imagen) {
            $errores[] = "La Imagen es Obligatoria";
        }

        return $errores;
    }

    public function guardar():bool
    {
        $attr = $this->sanitizeAtts();

        $query = "INSERT INTO propiedades (";
        $query .= join(", ", array_keys($attr));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attr));
        $query .= "')";

        self::$db->query($query);

        return true;
    }
}
