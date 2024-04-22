<?php

$conexion = new mysqli('localhost', 'root', '', 'prueba_datos');

if ($conexion->connect_errno) {
    die('Hubo un problema con el servidor');
} else {
//    Leer datos
//    $id = isset($_GET['id']) ? $_GET['id'] : 1;
//    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $sql1 = 'SELECT * FROM usuarios';
    $resultado = $conexion->query($sql1);

    if ($resultado->num_rows) {
       while($fila = $resultado->fetch_assoc()) { // mientras haya resultados ejecuta el código
           echo $fila['id'] . ' - ' . $fila['nombre'] . '<br />';
       }
    } else {
        echo 'No hay datos';
    }

//    Escribir datos
    $sql2 = "INSERT INTO usuarios(id, nombre, edad) VALUES(null, 'Luis', 50)";
    $conexion->query($sql2);
    if ($conexion->affected_rows >= 1) {
        echo 'Filas agregadas: ' . $conexion->affected_rows;
    }

//    Prepared statements
    $statement = $conexion->prepare("INSERT INTO usuarios(id, nombre, edad) VALUES(?, ?, ?)");

    $id = null;

    $statement->bind_param('ssi', $id, $nombre, $edad);

    if(isset($_GET['nombre']) && isset($_GET['edad'])) {
        $nombre = $_GET['nombre'];
        $edad = $_GET['edad'];
    }

    if ($conexion->affected_rows >= 1) {
        echo 'Filas agregadas: ' . $conexion->affected_rows;
    } else {
        echo 'No se agregó nada';
    }
}