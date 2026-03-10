<?php

require "../../includes/config/database.php";
require "../../includes/funciones.php";

incluirTemplate("header");

$db = conectarDB();
$errores = [];
$vendedores = [];

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT id, nombre, apellido FROM vendedores";
    $resultado = mysqli_query($db, $query);
    $vendedores = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedor'] ?? null;

    if (!$titulo) {
        $errores[] = "El título es obligatorio";
    }

    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }

    if (!$descripcion) {
        $errores[] = "La descripción es obligatoria";
    }

    if (!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = "El número de baños es obligatorio";
    }

    if (!$estacionamiento) {
        $errores[] = "El número de estacionamientos es obligatorio";
    }

    if (!$vendedorId) {
        $errores[] = "El vendedor es obligatorio";
    }

    if(empty($errores)) {
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedor_id, creado)";
        $query .= "VALUES (";
        $query .= "'$titulo', ";
        $query .= "'$precio', ";
        $query .= "'$descripcion', ";
        $query .= "'$habitaciones', ";
        $query .= "'$wc', ";
        $query .= "'$estacionamiento', ";
        $query .= "'$vendedorId', ";
        $query .= "CURRENT_DATE()";
        $query .= ");";

        $resultado = mysqli_query($db, $query);

        if($resultado) {
            header("Location: /admin?resultado=1");
        }
    }
}

?>

<main class="contenedor seccion">
    <h1>Crear nueva propiedad </h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php
    if (isset($errores)) {
        foreach ($errores as $error) {
            echo "<div class='alerta error'>$error</div>";
        }
    }
    ?>
    <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
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
                <option selected disabled value="-1">--Seleccione un Vendedor--</option>
                <?php
                foreach($vendedores as $vendedor) {
                    $id = $vendedor['id'];
                    $nombre = $vendedor['nombre'] . " " . $vendedor['apellido'];
                    echo "<option value='$id'>$nombre</option>";
                }
                ?>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate("footer"); ?>