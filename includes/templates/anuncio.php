<?php
$db = conectarDB();

$query = "SELECT * FROM propiedades LIMIT ".$limite.";";

$result = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">
    <?php while($propiedades = mysqli_fetch_assoc($result)): ?>
    <div class="anuncio">
        <div class="anuncio-imagen">
            <img loadin="lazy" src="imagenes/<?php echo $propiedades['imagen']; ?>" alt="anuncio1 jpg" type="jpeg">
        </div>    
        
        <div class="contenido-anuncio">
            <h3><?php echo $propiedades['titulo']; ?></h3>
            <?php $resumenDescripcion = substr($propiedades['descripcion'], 0, 40); ?>
            <p><?php echo $resumenDescripcion."..."; ?></p>
            <p class="precio"><?php echo $propiedades['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="src/img/icono_wc.svg" alt="icono baño">
                    <p><?php echo $propiedades['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" src="src/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedades['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" src="src/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedades['habitaciones']; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedades['id']; ?>" class="boton boton-amarillo-block">Ver Propiedad</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php
    //Cerrar conexión
    mysqli_close($db);
?>