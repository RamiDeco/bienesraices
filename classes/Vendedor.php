<?php

namespace App;

class Vendedor extends ActiveRecord
{
    protected static $table = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email', 'creado'];

    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $creado;

    public function __construct($args = []) 
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->creado = date('Y/m/d');

    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre";
        }
        if (!$this->apellido) {
            self::$errores[] = "Debes añadir un apellido";
        }
        if (!$this->telefono) {
            self::$errores[] = "Debes añadir un telefono";
        }
        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "Debes añadir un número de teléfono válido";
        }
        if (!$this->email) {
            self::$errores[] = "Debes añadir un email";
        }

        return self::$errores;
    }

}
