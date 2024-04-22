<?php

function contarUsuarios()
{
    $archivo = 'contador.txt';

    if (file_exists($archivo)) {
        $cuenta = file_get_contents($archivo) + 1;
        file_put_contents($archivo, $cuenta);

        return $cuenta;
    } else {
        file_put_contents($archivo, 1);
        return 1;
    }
}

//echo contarUsuarios();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Oswald:700,400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Contador de visitas</h1>
    <div class="visitantes">
        <p class="numero"><?php echo contarUsuarios(); ?></p>
        <p class="texto">Visitas</p>
    </div>
</body>
</html>
