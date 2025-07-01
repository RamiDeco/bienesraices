<?php
    require "includes/app.php";
    incluirTemplate("header");
?>

    <main>

        <h3>Casas y Depas en Venta</h3>
            <div class="contenedor-anuncios seccion contenedor">
            <?php
                $limite = 10; 
                include "includes/templates/anuncio.php";
            ?> 
            </div>
                

    </main>

<?php
    incluirTemplate("footer");
?>