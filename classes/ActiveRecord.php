<?php

namespace App;

class ActiveRecord
{
    protected static $db;
    protected static $columnasDB = [];
    protected static $errores;
    protected static $table;

    public $id;

    public static function setDB($db): void
    {
        self::$db = $db;
    }

    public function setAtributes(): array
    {
        $attr = [];
        foreach (static::$columnasDB as $column) {
            if ($column == 'id') continue;
            $attr[$column] = $this->$column;
        }

        return $attr;
    }

    public function sanitizeAtts(): array
    {
        $attr = $this->setAtributes();
        $sanitizedAtts = [];
        foreach ($attr as $key => $value) {
            $sanitizedAtts[$key] = self::$db->real_escape_string($value);
        }

        return $sanitizedAtts;
    }

    public function setImage($imagen): void
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
        static::$errores = [];
        return static::$errores;
    }

    public function save()
    {
        if (isset($this->id)) {
            $this->update();
        } else {
            $this->create();
        }
    }

    public function create()
    {
        $attr = $this->sanitizeAtts();

        $query = "INSERT INTO " . static::$table . " (";
        $query .= join(", ", array_keys($attr));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attr));
        $query .= "')";

        $result = self::$db->query($query);
        if ($result) {
            header("Location: /admin/index.php?resultado=1");
        }
    }

    public function update()
    {
        $attr = $this->sanitizeAtts();

        $values = [];
        foreach ($attr as $key => $value) {
            $values[] = $key . " = '" . $value . "'";
        }

        $query = "UPDATE " . static::$table . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id =" . $this->id . ";";

        $result = self::$db->query($query);

        if ($result) {
            header('Location: /admin/index.php?resultado=2');
        }
    }

    //Map results of the query in Propiedad objects
    protected static function createObj($row)
    {
        $obj = new static;

        foreach ($row as $key => $value) {
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
        while ($row = $result->fetch_assoc()) {
            $array[] = static::createObj($row);
        }

        $result->free();

        return $array;
    }

    public static function getAll()
    {
        $query = "SELECT * FROM " . static::$table . ";";

        $propiedades = self::querySQL($query);

        return $propiedades;
    }

    public static function findById($id)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE id = {$id}";

        $propiedad = self::querySQL($query);

        return array_shift($propiedad);
    }

    public function sync($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public static function getErrors()
    {
        return static::$errores;
    }

    public function delete()
    {
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . ";";

        $resultDel = self::$db->query($query);

        if (static::$table === 'propiedad' && $resultDel) {
            unlink(CARPETA_IMAGENES . $this->imagen);
            header("Location: /admin/index.php?resultado=3");
            exit();
        }

        header("Location: /admin/index.php?resultado=3");
        exit();
    }
}
