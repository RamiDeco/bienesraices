<?php
    require "../includes/app.php";

    use App\Propiedad;

    estaAutenticado();

    $propiedades = Propiedad::getAll();

    //Guardamos el id de la propiedad a eliminar
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id){
            //Eliminamos la imagen de la propiedad
            $queryImagen = "SELECT imagen FROM propiedades WHERE id = ".$id.";";
            $resultadoImagen = mysqli_query($db, $queryImagen);
            $propiedades = mysqli_fetch_assoc($resultadoImagen);
            unlink('../imagenes/'.$propiedades['imagen']); 

            //Realizamos consulta para eliminar
            $queryEliminar = "DELETE FROM propiedades WHERE id = ".$id.";";
            $resultadoEliminar = mysqli_query($db, $queryEliminar);

            if ($resultadoEliminar){
                header("Location: /admin/index.php?resultado=3");
                exit();
            }
        }
    }

    $resultado = $_GET['resultado'] ?? null;
    
    // Solo incluir el header después de procesar todo
    incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Administrador de Propiedades</h1>

    <?php if ($resultado == 1) : ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif ($resultado ==2) : ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif ($resultado ==3) : ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

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
                <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen;?>" alt="Imagen casa"></td>
                <td><?php echo $propiedad->precio;?></td>
                <td>
                    <form class="w-100" method="POST">
                        <input type="hidden" name="id" value=<?php echo $propiedad->id; ?>>
                        <input type="submit" class="boton-rojo-block" value="Borrar">
                    </form>
                    <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>

</main>

<?php
    incluirTemplate("footer");
?>