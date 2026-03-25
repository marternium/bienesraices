<?php
require "../../includes/funciones.php";
estaAutenticado();

require "../../includes/config/database.php";
incluirTemplate("header");

$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: /admin");
}

$db = conectarDB();
$errores = [];
$vendedores = [];

$query = "SELECT id, nombre, apellido FROM vendedores";
$resultado = mysqli_query($db, $query);
$vendedores = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);

$query = "SELECT * FROM propiedades WHERE id = $id";
$resultado = mysqli_query($db, $query);
$propiedad = mysqli_fetch_assoc($resultado);
mysqli_free_result($resultado);

if($propiedad) {
    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $wc = $propiedad["wc"];
    $estacionamiento = $propiedad["estacionamiento"];
    $vendedorId = $propiedad["vendedor_id"];
    $imagenPropiedad = $propiedad["imagen"];
} else {
    header("Location: /admin");
}


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = isset($_POST['vendedor']) ? mysqli_real_escape_string($db, $_POST['vendedor']) : "";
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "El título es obligatorio";
    } elseif (strlen($titulo) > 45) {
        $errores[] = "El título debe tener menos de 45 caracteres";
    }

    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }

    $medida = 1000 * 500;
    if($imagen["size"] > $medida) {
        $errores[] = "La imagen debe ser menor a 500kb";
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

        $carpetaImagenes = "../../imagenes/";
        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = "";

        if($imagen['name']) {
            unlink($carpetaImagenes . $imagenPropiedad);
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $imagenPropiedad;
        }


        $query = "UPDATE propiedades SET ";
        $query .= "titulo = '$titulo', ";
        $query .= "precio = '$precio', ";
        $query .= "imagen = '$nombreImagen', ";
        $query .= "descripcion = '$descripcion', ";
        $query .= "habitaciones = $habitaciones, ";
        $query .= "wc = $wc, ";
        $query .= "estacionamiento = $estacionamiento, ";
        $query .= "vendedor_id = $vendedorId ";
        $query .= "WHERE id = $id";
        $query .= ";";

        $resultado = mysqli_query($db, $query);

        if($resultado) {
            header("Location: /admin?resultado=2");
        }
    }
}

?>

<main class="contenedor seccion">
    <h1>Actualizar propiedad </h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php
    if (isset($errores)) {
        foreach ($errores as $error) {
            echo "<div class='alerta error'>$error</div>";
        }
    }
    ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título propiedad" value="<?php echo $titulo; ?>">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="imagen de la propiedad" class="imagen-small">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción propiedad"><?php echo $descripcion; ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Información Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Habitaciones" value="<?php echo $habitaciones; ?>">
            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="Baños" value="<?php echo $wc; ?>">
            <label for="estacionamiento">Estacionamientos</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Estacionamiento" value="<?php echo $estacionamiento; ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <label for="vendedor">Vendedor</label>
            <select name="vendedor" id="vendedor">
                <option <?php echo $vendedorId === "" ? "selected" : ""; ?> disabled value="-1">-- Seleccione un vendedor--</option>
                <?php foreach ($vendedores as $vendedor) { ?>
                    <option
                        <?php echo $vendedorId === $vendedor['id'] ? "selected" : ""; ?>
                        value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                    </option>
                <?php } ?>
            </select>
        </fieldset>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate("footer"); ?>