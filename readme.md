> [!IMPORTANT]
> Proyecto en construcción

# Bienes Raices
Proyecto del curso de Desarrollo Web de un negocio inmobiliario.

## Tecnologias Utilizadas
- HTML5
- SASS
- JavaScript
- MySQL
- PHP
- Gulp (con Node.js - npm)
- Composer

## Para utilizarlo

1. Clonar el repositorio
2. Instalar las dependencias con `npm i`
3. Iniciar el servicio de gulp con `npm run dev` para generar la carpeta build
4. Crear la base de datos con el archivo `bienesraices.sql`
4. Renombrar `ejemplo_db_variables.php` a `db_variables.php` y configurar las variables de la base de datos
5. Iniciar el servidor con `php -S localhost:3000`
6. Para acceder al panel de administración debes crear un usuario, para ello renombra el archivo `ejemplo_usuario.php` a `usuario.php` y coloca un email y password que desees utilizar, luego puedes ingresar a la url `http://localhost:3000/usuario.php` y se creará un usuario para acceder a el panel de administración mediante `http://localhost:3000/admin`.
7. Ejecutar `composer update` para instalar las dependencias de composer.