<?php
require "../../includes/app.php";

use App\Vendedor;

estaAutenticado();

//Obtener id de la propiedad
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin/index.php');
}

//Consulta para Prellenar los inputs
$vendedor = Vendedor::findById($id);

//Validacion de datos
$errores = Vendedor::getErrors();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $vendedor->sync($_POST['vendedor']);

    $errores = $vendedor->validar();

    if (empty($errores)) {
        $vendedor->save();
    }
}

incluirTemplate("header");

?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>

    <a href="/admin/index.php" class="boton boton-verde">Volver</a>

    <?php
    if (!empty($errores)):
        foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
    <?php endforeach;
    endif; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include "../../includes/templates/customer_form.php"; ?>
        <input type="submit" class="boton boton-verde" value="Actualizar Vendedor(a)">

    </form>
</main>