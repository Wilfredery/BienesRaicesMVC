<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud', '3306');

    if(!$db) {
        echo 'Error';
        exit;
    } 

    return $db;
}