<?php

// print_r($_GET);

if (!$_GET) {
    header('Location: http//localhost/CursoPHP/formularios/get');
}

$nombre = $_GET['nombre'];
// echo htmlspecialchars($_GET['nombre']);
$sexo = $_GET['sexo'];
$year = $_GET['year'];
$terminos = $_GET['terminos'];

if ($nombre) {
    echo $nombre . '<br />';
} else {
    echo "El usuario no estableció su nombre <br>";
}

echo $sexo . '<br />';
echo $year . '<br />';
echo $terminos . '<br />';
