<?php

require 'funciones.php';

$conexion = conexion('galeria', 'root', '');

if (!$conexion) {
//    header('Location: error.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES)) { // si está vacía es porque no envió el archivo
    $check = @getimagesize($_FILES['foto']['tmp_name']); // comprueba el tamaño de la imagen, si no es imagen retorna false
    if ($check !== false) {
        $carpeta_destino = 'fotos/';
        $archivo_subido = $carpeta_destino . $_FILES['foto']['name']; // fotos/img.jpg
        move_uploaded_file($_FILES['foto']['tmp_name'], $archivo_subido);

        $statement = $conexion->prepare('INSERT INTO fotos (titulo, imagen, texto) 
                                        VALUES (:titulo, :imagen, :texto)');
        $statement->execute(array(
            ':titulo' => $_POST['titulo'],
            ':imagen' => $_FILES['foto']['name'],
            ':texto' => $_POST['texto']));

        header('Location: index.php');
    } else {
        $error = 'El archivo no es una imagen o el archivo es muy pesado';
    }
}

require 'views/subir.view.php';

?>