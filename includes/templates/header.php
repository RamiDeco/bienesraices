<?php
    if (!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>"> <!-- El codigo de php revisa si existe la variable inicio y escribe inicio, sino no escribe nada -->
        <div class="contenedor contenido-header">

            <div class="barra">
                
                <a href="/index.php">
                    <img src="/build/img/logo.svg" alt="Logo principal">
                </a>
                
                <div class="mobile">
                    <img src="/build/img/barras.svg" alt="Hamburguesa">
                </div>

                
                <div class="contenido-derecha">
                    <img class="boton-dark-mode" src="/build/img/dark-mode.svg" alt="boton dark mode">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contactos.php">Contactos</a>
                        <?php if($auth):  ?>
                            <a href="cerrar-sesion.php">Cerrar Sesion</a>
                        <?php endif;  ?>
                    </nav>
                </div>
                

            </div>
            <?php if($inicio): ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php  endif; ?>
        </div>

    </header>