<?php

$errores = '';

if (isset($_POST['sumbit'])) { //comprobar si esta seteada, el usuario ya envió el formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    if (!empty($nombre)) {
//        $nombre = trim($nombre); //quita los espaciados
//        $nombre = htmlspecialchars($nombre); //convierte los caracteres especiales en entidades html
//        $nombre = stripcslashes($nombre); //remueve los símbolos

        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING); //pasar una parametro que queremos limpiar
        echo "Tu nombre es: $nombre . <br />";
    } else {
        $errores .= 'Por favor agrega un nombre <br />';
    }

    if (!empty($correo)) {
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores .= 'Por favor agrega un correo válido';
        } else {
            echo "Tu correo es: $correo";
        }
    } else {
        $errores .= 'Por favor agrega un correo';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="text" name="nombre" placeholder="nombre">
    <input type="email" name="correo" placeholder="correo">

    <?php if (!empty($errores)): ?>
        <div class="error"><?php echo $errores; ?></div>
    <?php endif; ?>

    <input type="submit" name="sumbit">
</form>
</body>
</html>