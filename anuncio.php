<?php
require "includes/funciones.php";
incluirTemplate("header");
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="imagen de la propiedad" loading="lazy">
        </picture>
        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="icono baño" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                    <p>4</p>
                </li>
            </ul>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, expedita. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi sit expedita corporis magnam minima dolor, tenetur nobis laboriosam odit vitae amet laudantium, facilis beatae aliquam molestias debitis excepturi quis. Praesentium. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad iste, sunt quidem aliquam numquam pariatur adipisci iusto atque dignissimos. Iusto, dicta. Eligendi nostrum facilis sed ipsam rerum accusamus reprehenderit officiis.
            </p>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere, fugiat ducimus eius maxime quos ipsum blanditiis quibusdam expedita mollitia enim dicta? Voluptatum voluptatem excepturi dolore asperiores expedita tempora at velit!
            </p>
        </div>
    </main>

<?php incluirTemplate("footer"); ?>