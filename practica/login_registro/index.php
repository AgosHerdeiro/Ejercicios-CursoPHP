<?php

session_start();

if (isset($_SESSION['usuarios'])) {
    header('Location: contenido.php');
    die();
} else {
    header('Location: registrate.php');
}

?>