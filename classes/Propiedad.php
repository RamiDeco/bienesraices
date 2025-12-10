<?php

namespace App;

class Propiedad
{
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];
    protected static $errores;

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
        $this->vendedorId = $args['vendedorId'] ?? '1';
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
        //Eliminar imagen anterior
        if ($this->id) {
            if ($imagen) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function validar()
    {
        $errores = [];

        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }
        if (strlen($this->titulo) > 24) {
            self::$errores[] = "Debes añadir un título más corto";
        }
        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
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

    public function save()
    {
        if (isset($this->id)) {
            return $this->update();
        }
        return $this->create();
    }

    public function create()
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

    public function update() {
        $attr = $this->sanitizeAtts();

        $values = [];
        foreach($attr as $key => $value) {
            $values[] = $key . " = '" . $value . "'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id =" . $this->id . ";";

        self::$db->query($query);

        return true;
    }

    //Map results of the query in Propiedad objects
    protected static function createObj($row)
    {
        $obj = new self;

        foreach($row as $key => $value) {
            if (property_exists($obj, $key)) {
                $obj->$key = $value;
            }
        }

        return $obj;
    }

    public static function querySQL($query)
    {
        $result = self::$db->query($query);

        $array = [];
        while($row = $result->fetch_assoc()) {
            $array[] = self::createObj($row);
        }

        $result->free();

        return $array;
    }

    public static function getAll()
    {
        $query = "SELECT * FROM propiedades;";

        $propiedades = self::querySQL($query);

        return $propiedades;
    }

    public static function findById($id)
    {
        $query = "SELECT * FROM propiedades WHERE id = {$id}";

        $propiedad = self::querySQL($query);

        return array_shift($propiedad);
    }

    public function sync($args = [])
    {
        foreach($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public static function getErrors() {
        return self::$errores;
    }

    public function delete() {
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id).";";
        $resultDel = self::$db->query($query);

        if ($resultDel){
                unlink(CARPETA_IMAGENES . $this->imagen);
                header("Location: /admin/index.php?resultado=3");
                exit();
            }

    }
}
