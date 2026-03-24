<?php
require "../includes/config/database.php";

$db = conectarDB();

$query = "SELECT id, titulo, precio, imagen FROM propiedades";
$resultadoConsulta = mysqli_query($db, $query);

$resultado = $_GET["resultado"] ?? null;
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
                    <a href="" class="boton boton-rojo-block">Eliminar</a>
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