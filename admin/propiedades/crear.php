<?php
require "../../includes/app.php";
use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

estaAutenticado();

incluirTemplate("header");

$db = conectarDB();
$errores = Propiedad::getErrores();
$vendedores = [];
$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = "";
$wc = "";
$estacionamiento = "";
$vendedorId = "";

$query = "SELECT id, nombre, apellido FROM vendedores";
$resultado = mysqli_query($db, $query);
$vendedores = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST);

    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    if($_FILES['imagen']['tmp_name']) {
        $manager = new Image(Driver::class);
        $imagen = $manager->decodePath($_FILES['imagen']['tmp_name'])->cover(800,600);
        $propiedad->setImagen($nombreImagen);
    }

    $errores = $propiedad->validar();

    $titulo = $_POST['titulo'] ?? "";
    $precio = $_POST['precio'] ?? "";
    $descripcion = $_POST['descripcion'] ?? "";
    $habitaciones = $_POST['habitaciones'] ?? "";
    $wc = $_POST['wc'] ?? "";
    $estacionamiento = $_POST['estacionamiento'] ?? "";
    $vendedorId = $_POST['vendedorId'] ?? "";

    if(empty($errores)) {

        if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        $imagen->save(CARPETA_IMAGENES . $nombreImagen);

        $resultado = $propiedad->guardar();

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
    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título propiedad" value="<?php echo $titulo; ?>">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
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
            <select name="vendedorId" id="vendedorId">
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
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate("footer"); ?>