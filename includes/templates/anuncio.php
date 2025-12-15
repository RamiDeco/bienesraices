<?php

use App\Propiedad;

$propiedades = Propiedad::getAll();

?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
    <div class="anuncio">
        <div class="anuncio-imagen">
            <img loadin="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio1 jpg" type="jpeg">
        </div>    
        
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <?php $resumenDescripcion = substr($propiedad->descripcion, 0, 40); ?>
            <p><?php echo $resumenDescripcion."..."; ?></p>
            <p class="precio"><?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="src/img/icono_wc.svg" alt="icono baño">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono" src="src/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" src="src/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo-block">Ver Propiedad</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>