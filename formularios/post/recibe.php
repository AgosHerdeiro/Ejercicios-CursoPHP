<?php

// print_r($_POST);

if (!$_POST) {
    header('Location: http//localhost/CursoPHP/formularios/post');
}

$nombre = $_POST['nombre'];
$sexo = $_POST['sexo'];
$year = $_POST['year'];
$terminos = $_POST['terminos'];

echo 'Hola, ' . $nombre . ' eres ' . $sexo;