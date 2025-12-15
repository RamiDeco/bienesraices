<fieldset>
    <legend>Información General</legend>

    <label for="titulo">titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad" value="<?php echo s($propiedad->titulo) ?>">

    <label for="precio">precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio) ?>">

    <label for="imagen">imagen:</label>
    <input type="file" accept="image/jpeg, image/png" id="imagen" name="propiedad[imagen]">
    <?php if ($propiedad->id): ?>
        <img class="imagen-form" src="<?php echo '/imagenes/' . $propiedad->imagen ?>" alt="<?php echo $propiedad->titulo ?>" width="100" height="100">
    <?php endif; ?>

    <label for="descripcion">descripcion:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion) ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones) ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc) ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento) ?>">

</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedores">Vendedores</label>
    <select name="propiedad[vendedorId]" id="vendedores">
        <?php foreach ($vendedores as $vendedor): ?>
            <option
                <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; ?>
                value="<?php echo $vendedor->id; ?>">
                <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?>
            </option>
        <?php endforeach; ?>
    </select>

</fieldset>