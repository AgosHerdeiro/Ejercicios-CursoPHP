<?php

session_start();

session_destroy();
$_SESSION = array(); // limpiamos la sesión, la dejamos en 0

header('Location: login.php');

?>