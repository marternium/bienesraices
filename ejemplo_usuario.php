<?php

require "includes/app.php";
$db = conectarDB();

$email = ""; //coloca aquí tu email de administrador
$password = ""; //coloca aqui tu password de administrador

$password = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$password')";
$resultado = mysqli_query($db, $query);

if($resultado) {
    header("Location: /login.php");
}