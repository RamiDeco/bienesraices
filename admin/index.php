<?php
require "../includes/app.php";

use App\Propiedad;
use App\Vendedor;

estaAutenticado();

$propiedades = Propiedad::getAll();
$vendedores = Vendedor::getAll();

//Guardamos el id de la propiedad a eliminar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        echo 'no hay id';
        return;
    }

    $type = $_POST['type'];
    if (validateType($type)) {
        if ($type === 'propiedad') {
            $propiedad = Propiedad::findById($id);
            $propiedad->delete();
        } elseif ($type === 'vendedor') {
            $vendedor = Vendedor::findById($id);
            $vendedor->delete();
        }
    }
}

$resultado = $_GET['resultado'] ?? null;

// Solo incluir el header después de procesar todo
incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Administrador</h1>

    <?php if ($resultado): ?>
        <p class="alerta exito"><?php echo generateMessage($resultado); ?></p>
    <?php endif; ?>

    <h2>Propiedades</h2>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <?php foreach ($propiedades as $propiedad): ?>
            <tbody>
                <tr>
                    <td> <?php echo $propiedad->id; ?> </td>
                    <td> <?php echo $propiedad->titulo; ?></td>
                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen casa"></td>
                    <td><?php echo $propiedad->precio; ?></td>
                    <td>
                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value=<?php echo $propiedad->id; ?>>
                            <input type="hidden" name="type" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Borrar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <?php foreach ($vendedores as $vendedor): ?>
            <tbody>
                <tr>
                    <td> <?php echo $vendedor->id; ?> </td>
                    <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td><?php echo $vendedor->email; ?></td>
                    <td>
                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value=<?php echo $vendedor->id; ?>>
                            <input type="hidden" name="type" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Borrar">
                        </form>
                        <a href="vendedores/actualizar.php?id=<?php echo $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

</main>

<?php
incluirTemplate("footer");
?>