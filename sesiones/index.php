<?php
session_start();

$_SESSION['nombre'] = 'Carlos';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Pagina de Inicio</h1>
    <p>Has cargado una nueva sesión</p>
    <a href="pagina2.php">Ir a la pagina 2</a>
</body>
</html>