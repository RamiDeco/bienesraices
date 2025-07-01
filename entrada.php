<?php
    require "includes/app.php";
    incluirTemplate("header");
?>

    <main>

        <div class="contenedor seccion contenido-centrado">
            <h1>Guía para la decoración de tu hogar</h1>

                <picture>
                    <source srcset="build/img/destacada2.webp" type="image/webp">
                    <source srcset="build/img/destacada2.jpg" type="image/jpeg">
                    <img src="build/img/destacada2.jpg" alt="Imagen destacada">
                </picture>

            <div class="contenido-anuncio informacion-meta">
                <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, itaque placeat perferendis excepturi nobis porro ullam consequuntur laboriosam illo aut iste dolorum magnam dolor numquam quae nam reprehenderit asperiores cum!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, itaque placeat perferendis excepturi nobis porro ullam consequuntur laboriosam illo aut iste dolorum magnam dolor numquam quae nam reprehenderit asperiores cum! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, itaque placeat perferendis excepturi nobis porro ullam consequuntur laboriosam illo aut iste dolorum magnam dolor numquam quae nam reprehenderit asperiores cum!Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                </p>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, itaque placeat perferendis excepturi nobis porro ullam consequuntur laboriosam illo aut iste dolorum magnam dolor numquam quae nam reprehenderit asperiores cum!Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                </p>
            </div>
        </div>

    </main>

    <?php
    incluirTemplate("footer");
    ?>