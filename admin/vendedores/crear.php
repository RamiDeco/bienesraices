<?php

require "../../includes/app.php";

use App\Vendedor;

estaAutenticado();

$errores = [];

$vendedor = new Vendedor;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendedor = new Vendedor($_POST['vendedor']);

    $errores = $vendedor->validar();

    if (empty($errores)) {
        $vendedor->save();
    }
}

incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Crear Vendedor(a)</h1>

    <a href="/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include "../../includes/templates/customer_form.php"; ?>
        <input type="submit" class="boton boton-verde" value="Crear Vendedor">

    </form>
</main>

<?php
incluirTemplate("footer");
?>