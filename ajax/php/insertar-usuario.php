<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$pais = $_POST['pais'];
$correo = $_POST['correo'];

function validadDatos($nombre, $edad, $pais, $correo)
{
    if ($nombre = '') {
        return false;
    } elseif ($edad == '' || is_int($edad)) {
        return false;
    } elseif ($pais == '') {
        return false;
    } elseif ($correo == '') {
        return false;
    }
    return true;
}

if (validadDatos($nombre, $edad, $pais, $correo)) {
    $conexion = new mysqli('localhost', 'root', '', 'ajax');
    $conexion->set_charset('utf8');

    if ($conexion->connect_errno) {
        $respuesta = ['error' => true];
    } else {
        $statement = $conexion->prepare("INSERT INTO usuarios (nombre, edad, pais, correo) VALUES (?, ?, ?, ?)");
        $statement->bind_param("siss", $nombre, $edad, $pais, $correo); // string int string string
        $statement->execute();

        if ($conexion->affected_rows <= 0) {
            $respuesta = ['error' => true];
        }

        $respuesta = ['error' => false];
    }
} else {
    $respuesta = ['error' => true];
}

echo json_encode($respuesta);