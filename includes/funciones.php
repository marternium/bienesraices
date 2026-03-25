<?php
require "app.php";
function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}

function estaAutenticado() {
    session_start();
    if(!$_SESSION["login"]) {
        header("Location: /login.php");
    }
}