<?php
    require "includes/app.php";
    incluirTemplate("header");
?>

    <main>
        <section>
            <h1>Conoce Sobre Nosotros</h1>
            <div class="seccion contenedor contenedor-nosotros">
                <div class="imagen-nosotros">
                    <picture>
                        <source srcset="build/img/nosotros.webp" type="image/webp">
                        <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen Nosotros">
                    </picture>
                </div>
                
                <div class="contenido-nosotros">
                    <h4>25 Años de Experiencia</h4>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, itaque placeat perferendis excepturi nobis porro ullam consequuntur laboriosam illo aut iste dolorum magnam dolor numquam quae nam reprehenderit asperiores cum!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, itaque placeat perferendis excepturi nobis porro ullam consequuntur laboriosam illo aut iste dolorum magnam dolor numquam quae nam reprehenderit asperiores cum! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, itaque placeat perferendis excepturi nobis porro ullam consequuntur laboriosam illo aut iste dolorum magnam dolor numquam quae nam reprehenderit asperiores cum!Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    </p>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, itaque placeat perferendis excepturi nobis porro ullam consequuntur laboriosam illo aut iste dolorum magnam dolor numquam quae nam reprehenderit asperiores cum!Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
            </div>
        </section>

        <section class="contenedor contenido-iconos">
            <div class="iconos">
                <img src="src/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident praesentium, vel aspernatur pariatur facilis voluptate voluptatum sed deserunt ratione minus obcaecati nulla est dicta nisi repudiandae optio placeat nihil doloremque?</p>
            </div>
            <div class="iconos">
                <img src="src/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident praesentium, vel aspernatur pariatur facilis voluptate voluptatum sed deserunt ratione minus obcaecati nulla est dicta nisi repudiandae optio placeat nihil doloremque?</p>
            </div>
            <div class="iconos">
                <img src="src/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident praesentium, vel aspernatur pariatur facilis voluptate voluptatum sed deserunt ratione minus obcaecati nulla est dicta nisi repudiandae optio placeat nihil doloremque?</p>
            </div>
        </section>
        

    </main>

    <?php
    incluirTemplate("footer");
    ?>