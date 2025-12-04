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


//Validacion de datos
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';


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
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

            <label for="imagen">imagen:</label>
            <input type="file" accept="image/jpeg, image/png" id="imagen" name="imagen">

            <label for="descripcion">descripcion:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId">
                <option value="">--Seleccione--</option>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <option <?php echo $vendedorId == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"> <?php echo $row['nombre'] . " " . $row['apellido']; ?> </option>
                <?php endwhile; ?>
            </select>

        </fieldset>

        <input type="submit" class="boton boton-verde" value="Crear Propiedad">
    </form>
</main>

<?php
incluirTemplate("footer");
?>