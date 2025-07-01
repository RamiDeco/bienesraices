<?php

    require "../../includes/funciones.php";

    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /index.php');
    }

    //Base de datos
    require "../../includes/config/database.php";
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
    
    
 if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $imagen = $_FILES['imagen'];

    $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
    $precio = mysqli_real_escape_string( $db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string( $db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor']);
    $creado = date('Y/m/d');   

    $medida = 1000 * 1000;

    if (!$titulo){
    $errores[] = "Debes añadir un título";
    }
    if (strlen($titulo) > 24){
        $errores[] = "Debes añadir un título más corto";
        }
    if (!$precio){
        $errores[] = "Debes añadir un precio";
    }
    if (!$descripcion){
        $errores[] = "Debes añadir una descripcion";
    }
    if (strlen($descripcion) < 40){
        $errores[] = "Debes añadir una descripcion más larga";
    }
    if (!$habitaciones){
        $errores[] = "Debes añadir cantidad de habitaciones";
    }
    if (!$wc){
        $errores[] = "Debes añadir cantidad de wc";
    }
    if (!$estacionamiento){
        $errores[] = "Debes añadir cantidad de estacionamientos";
    }
    if (!$vendedorId){
        $errores[] = "Debes elegir un vendedor";
    }
    if (!$imagen['name'] || $imagen['error'] ){
        $errores[] = "La Imagen es Obligatoria";
    }
    if ($imagen['size'] > $medida){
        $errores[] = "La Imagen es muy grande";
    }



    if (empty($errores)){
        //Crear carpeta para guardar imagenes  
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes, 0755, true);
        }
        
        // Asegurar permisos de escritura
        chmod($carpetaImagenes, 0755);

        //Crear nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg"; 

        //Guardar imagenes en carpeta
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        
        //Consulta base de datos
        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId');";

        $result = mysqli_query($db, $query);

        if ($result){
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
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>" >

            <label for="imagen">imagen:</label>
            <input type="file" accept="image/jpeg, image/png" id="imagen" name="imagen" >

            <label for="descripcion">descripcion:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones"  placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc"  placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento"  placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">--Seleccione--</option>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <option <?php echo $vendedorId == $row['id'] ? 'selected' : ''; ?> value=" <?php echo $row['id']; ?> "> <?php echo $row['nombre'] . " " . $row['apellido']; ?> </option>
                <?php endwhile; ?>
            </select>

        </fieldset>

        <input type="submit" class="boton boton-verde" value="Crear Propiedad">
    </form>
</main>

<?php
    incluirTemplate("footer");
?>