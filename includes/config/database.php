<?php

require "db_variables.php";

function conectarDB() {
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($db){
        echo "Conectado";
    } else {
        echo "Error";
    }
}

conectarDB();