<?php

function conexion($tabla, $usuario, $pass)
{
    try {
        $conexion = new PDO("mysql:host=localhost;dbname=$tabla", $usuario, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conexion;
    } catch (PDOException $e) {
        return false;
    }
}

?>