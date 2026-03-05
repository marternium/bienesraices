<?php
require "../../includes/funciones.php";
incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Crear nueva propiedad </h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <form class="formulario">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título propiedad">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción propiedad"></textarea>
        </fieldset>
        <fieldset>
            <legend>Información Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Habitaciones">
            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="Baños">
            <label for="estacionamiento">Estacionamientos</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Estacionamiento">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <label for="vendedor">Vendedor</label>
            <select name="vendedor" id="vendedor">
                <option selected disabled value="">--Seleccione un Vendedor--</option>
                <option value="1">Vendedor 1</option>
                <option value="2">Vendedor 2</option>
                <option value="3">Vendedor 3</option>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate("footer"); ?>