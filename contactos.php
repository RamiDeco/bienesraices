<?php
    require "includes/app.php";
    incluirTemplate("header");
?>

    <main>

        <h1>Contacto</h1>

        <div class="contenedor seccion  contenedor-contacto">
            <picture>
                <source srcset="build/img/destacada3.webp" type="image/webp">
                <source srcset="build/img/destacada3.jpg" type="image/jpeg">
                <img src="build/img/destacada3.jpg" alt="Imagen Contacto">
            </picture>

            <h2>Llene el Formulario de Contacto</h2>

            <form class="formulario">

                <fieldset>
                    <legend>Información Personal</legend>

                    <label for="nombre">Nombre</label>
                    <input type="text" placeholder="Tu Nombre" id="nombre">

                    <label for="email">Email</label>
                    <input type="email" placeholder="Tu Email" id="email">

                    <label for="telefono">Teléfono</label>
                    <input type="tel" placeholder="Tu Teléfono" id="telefono">

                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje"></textarea>
                </fieldset>
                <fieldset>
                    <legend>Información Sobre la Propiedad</legend>
                    <label for="opciones">Vende o Compra:</label>
                    <select id="opciones">
                        <option value="" disabled selected>-- Seleccione --</option>
                        <option value="Compra">Compra</option>
                        <option value="Vende">Vende</option>
                    </select>

                    <label for="presupuesto">Precio o presupuesto</label>
                    <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto">

                </fieldset>
                <fieldset>
                    <legend>Información Sobre la Propiedad</legend>

                    <p>Como desea ser contactado</p>

                    <div class="forma-contacto">
                        <label for="contactar-telefono">Teléfono</label>
                        <input name="contacto" type="radio" value="telefono" id="contactar-telefono"> <!-- El name tiene que ser igual para solo poder seleccionar una opcion-->
    
                        <label for="contactar-email">E-mail</label>
                        <input name="contacto" type="radio" value="email" id="contactar-email">
                    </div>

                    <p>Si eligió teléfono elija la fecha y hora</p>

                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha">

                    <label for="hora">Hora:</label>
                    <input type="time" id="hora">
                </fieldset>

                <input type="submit" value="Enviar" class="boton-verde">
            </form>
        </div>
        


    </main>

    <?php
    incluirTemplate("footer");
    ?> 