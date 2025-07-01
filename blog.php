<?php
    require "includes/app.php";
    incluirTemplate("header");
?>

    <main>

        <h1>Blog</h1>

        <div class="seccion contenido-centrado contenedor">
            <article class="entrada-blog ">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="imagen/webp">
                        <source srcset="build/img/blog1.jpg" type="imagen/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen blog default">
                    </picture>
                </div>
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                </a>
                
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="imagen/webp">
                        <source srcset="build/img/blog2.jpg" type="imagen/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen blog default">
                    </picture>
                </div>
                <a href="entrada.php">
                    <h4>Guía para decoración de tu hogar</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                    <p>Maximiza el espacio en tu casa con estos increibles trucos que además te haran ganar dinero</p>
                </a>
                
            </article>
            <article class="entrada-blog ">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="imagen/webp">
                        <source srcset="build/img/blog1.jpg" type="imagen/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen blog default">
                    </picture>
                </div>
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                </a>
                
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog4.webp" type="imagen/webp">
                        <source srcset="build/img/blog4.jpg" type="imagen/jpeg">
                        <img loading="lazy" src="build/img/blog4.jpg" alt="Imagen blog default">
                    </picture>
                </div>
                <a href="entrada.php">
                    <h4>Guía para decoración de tu hogar</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                    <p>Maximiza el espacio en tu casa con estos increibles trucos que además te haran ganar dinero</p>
                </a>
        </div>
        

    </main>

    <?php
    incluirTemplate("footer");
    ?>