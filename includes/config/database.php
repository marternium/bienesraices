<?php

require "db_variables.php";

function conectarDB() : mysqli {
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        exit;
    }

    return $db;
}

conectarDB();