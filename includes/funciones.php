<?php

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__."funciones.php");
define("CARPETA_IMAGENES", __DIR__ . "/../imagenes/");

function incluirTemplate($nombre, $inicio=false){
    include TEMPLATES_URL."/{$nombre}.php";
}

function estaAutenticado() {
    session_start();

    if(!$_SESSION){
        header('Location: /index.php');
    } elseif ($_SESSION["login"]) {
        return true;
    }
}

function debug($var): void {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die;
}

function s($html) {
    $result = htmlspecialchars($html);

    return $result;
}

function validateType($type) {
    $allowedTypes = ['propiedad', 'vendedor'];
    
    return in_array($type, $allowedTypes);
}

function generateMessage($code) {
    $message = '';
    switch($code) {
        case 1:
            $message = 'Creado correctamente';
            break;
        case 2:
            $message = 'Actualizado correctamente';
            break;
        case 3:
            $message = 'Eliminado correctamente';
            break;
        default:
            $message = false;
            break;
    }

    return $message;
}