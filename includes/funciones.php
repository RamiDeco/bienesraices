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
}