<?php

try {
    $conexion = new PDO('mysql:host=localhost;dbname=prueba_datos', 'root', '');
    echo "Conexión OK";

    // Método Query
    $resultados = $conexion->query('SELECT * FROM usuarios');

    foreach ($resultados as $fila) {
        echo $fila['nombre'] . '<br />';
    }

    // Prepared Statements
    $id = $_GET['id'];

    $statement = $conexion->prepare('SELECT * FROM usuarios WHERE id = :id'); // No se ejecuta, la estamos preparando
    $statement->execute(
        array(':id' => $id)
    );

    $resultado = $statement->fetch();
    echo "<pre>";
    print_r($resultado);
    echo "</pre>";

//    $resultados = $statement->fetchAll();
//    foreach ($resultados as $usuario) {
//        echo $usuario['nombre'] . '<br>';
//    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>