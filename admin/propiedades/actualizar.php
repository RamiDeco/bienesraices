<?php
require "../../includes/app.php";

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

estaAutenticado();

//Obtener id de la propiedad
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /admin/index.php');
}

//Consulta para Prellenar los inputs
$propiedad = Propiedad::findById($id);

$vendedores = Vendedor::getAll();

//Validacion de datos
$errores = Propiedad::getErrors();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $args = $_POST['propiedad'];

    $propiedad->sync($args);

    $errores = $propiedad->validar();

    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        //Crear nombre único
        $imageName = md5(uniqid(rand(), true)) . ".jpg";

        $manager = new Image(Driver::class);
        $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);

        //Setear nombre en base de datos
        $propiedad->setImage($imageName);

        if (empty($errores)) {
            $image->save(CARPETA_IMAGENES . $imageName);
        }
    }

    if (empty($errores)) {        
        $propiedad->save();
    }
}


incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Actualizar</h1>

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
        <?php include '../../includes/templates/propiedad_form.php'; ?>

        <input type="submit" class="boton boton-verde" value="Actualizar propiedad">
    </form>
</main>

<?php
incluirTemplate("footer");
?>