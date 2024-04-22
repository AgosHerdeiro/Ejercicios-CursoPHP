<?php

session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    die();
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = hash('sha512', $password);

    try {
        $conexion = new PDO('mysql:host=localhost;dbname=login', 'root', '');
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario AND pass = :pass');
    $statement->execute(array(':usuario' => $usuario, ':pass' => $password));

    $resultado = $statement->fetch();
    if ($resultado !== false) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
    } else {
        $errores .= '<li>Datos incorrectos</li>';
    }
}

require 'views/login.view.php';

?>