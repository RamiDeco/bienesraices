<?php

require "../../includes/app.php";

use App\Propiedad;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

estaAutenticado();

//Base de datos
$db = conectarDB();

//Obtener datos de vendedores de la base de datos
$consulta = "SELECT * FROM vendedores;";
$result = mysqli_query($db, $consulta);


$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST);

    if ($_FILES['imagen']['tmp_name']) {
        //Crear nombre único
        $imageName = md5(uniqid(rand(), true)) . ".jpg";

        $manager = new Image(Driver::class);
        $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);

        //Setear nombre en base de datos
        $propiedad->setImage($imageName);
    }

    $errores = $propiedad->validar();

    if (empty($errores)) {
        //Crear carpeta para guardar imagenes
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES, 0755, true);
        }

        //Guardar imagenes en carpeta
        $image->save(CARPETA_IMAGENES . $imageName);

        $result = $propiedad->guardar();
        if ($result) {
            header("Location: /admin/index.php?resultado=1");
        }
    }
}



incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        
        <?php include '../../includes/templates/propiedad_form.php';?>

        <input type="submit" class="boton boton-verde" value="Crear Propiedad">
    </form>
</main>

<?php
incluirTemplate("footer");
?>