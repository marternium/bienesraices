<?php
require "../includes/config/database.php";

$db = conectarDB();

$query = "SELECT id, titulo, precio, imagen FROM propiedades";
$resultadoConsulta = mysqli_query($db, $query);

$resultado = $_GET["resultado"] ?? null;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if($id) {
        $query = "SELECT imagen FROM propiedades WHERE id = $id";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink("../imagenes/" . $propiedad["imagen"]);
        $query = "DELETE FROM propiedades WHERE id = $id";
        $resultado = mysqli_query($db, $query);

        if($resultado) {
            header("Location: /admin?resultado=3");
        }
    }
}

require "../includes/funciones.php";
incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if ($resultado == 1) { ?>
        <p class="alerta exito"> La nueva propiedad se guardo correctamente </p>
    <?php } elseif ($resultado == 2) { ?>
        <p class="alerta exito"> La propiedad se actualizo correctamente </p>
    <?php } elseif ($resultado == 3) { ?>
        <p class="alerta exito"> La propiedad se elimino correctamente </p>
    <?php } ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $propiedad["id"]; ?></td>
                <td><?php echo $propiedad["titulo"]; ?></td>
                <td><img src="imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen de la propiedad" class="imagen-tabla"></td>
                <td>$<?php echo $propiedad["precio"]; ?></td>
                <td>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad["id"]; ?>">
                        <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"]; ?>" class="boton boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
mysqli_close($db);
incluirTemplate("footer");
?>