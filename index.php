<?php
    require "includes/app.php";
    incluirTemplate("header", $inicio = true);
?>

    <main>

        <h1>Más Sobre Nosotros</h1>

        <div class="contenedor contenido-iconos">
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
        </div>

        <section class="seccion contenedor">
            <h3>Casas y Depas en Venta</h3>
            <?php
                $limite = 3; 
                include "includes/templates/anuncio.php";
            ?> 
            <div class="alinear-derecha">
                <a href="anuncios.php" class="boton boton-verde">Ver todas</a>
            </div>
        </section>

        <section class="contactanos seccion">
            <div class="contenedor-contactar">
                <h2>Encuentra la casa de tus sueños</h2>
                <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
                <a href="contactos.html" class="boton boton-amarillo">Contáctanos</a>
            </div>
        </section>

        <div class="contenedor seccion seccion-inferior">
            <section class="blog">
                <h3>Nuestro Blog</h3>

                <article class="entrada-blog">
                    <div class="imagen">
                        <picture>
                            <source srcset="build/img/blog1.webp" type="imagen/webp">
                            <source srcset="build/img/blog1.jpg" type="imagen/jpeg">
                            <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen blog default">
                        </picture>
                    </div>
                    <a href="blog.html">
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
                    <a href="blog.html">
                        <h4>Guía para decoración de tu hogar</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                        <p>Maximiza el espacio en tu casa con estos increibles trucos que además te haran ganar dinero</p>
                    </a>
                    
                </article>
            </section>
            <section class="testimoniales">
                <h3>Testimoniales</h3>
                <div class="testimoniales-contenido">
                    <blockquote>El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.</blockquote>
                    <p>-Ramiro de Coninck</p>
                </div>
            </section>
        </div>

    </main>

<?php
    include "./includes/templates/footer.php";
?>
