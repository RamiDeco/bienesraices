<?php
    require "includes/app.php";
    incluirTemplate("header");

    //Obtener ID de la propiedad

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /index.php');
    }

    

    $db = conectarDB();

    $query = "SELECT * FROM propiedades WHERE id=".$id.";";

    $result = mysqli_query($db, $query);

    $propiedad = mysqli_fetch_assoc($result);

    if (!$result->num_rows){
        header("Location: /index.php");
    }
?>

    <main>

        <div class="contenedor seccion contenido-centrado">
            <h2><?php echo $propiedad['titulo'];?></h2>

            <div class="imagen-anuncio">
                    <img src="imagenes/<?php echo $propiedad['imagen'];?>" alt="Imagen destacada">
            </div>

            <div class="contenido-anuncio">
                <p class="precio">$<?php echo $propiedad['precio'];?></p>
                <ul class="iconos-caracteristicas-normal">
                    <li>
                        <img src="src/img/icono_wc.svg" alt="icono baño">
                        <p><?php echo $propiedad['wc'];?></p>
                    </li>
                    <li>
                        <img src="src/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad['estacionamiento'];?></p>
                    </li>
                    <li>
                        <img src="src/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad['habitaciones'];?></p>
                    </li>
                </ul>
                <p>
                    <?php echo $propiedad['descripcion'];?>
                </p>
            </div>
        </div>

    </main>

    <?php
    mysqli_close($db);
    
    incluirTemplate("footer");
    ?>