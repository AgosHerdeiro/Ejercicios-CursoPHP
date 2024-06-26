<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>Mi Increíble Galería en PHP</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <div class="contenedor">
            <h1 class="titulo">Subir foto</h1>
        </div>
    </header>
        <div class="contenedor">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="formulario">
                <label for="foto">Selecciona tu foto</label>
                <input type="file" name="foto" id="foto">

                <label for="titulo">Título de la foto</label>
                <input type="text" name="titulo" id="titulo">

                <label for="texto">Descripción</label>
                <textarea name="texto" id="texto" placeholder="Ingresa una descripción"></textarea>

                <?php if (isset($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>

                <input type="submit" class="submit" value="Subir foto">
            </form>
        </div>

    <footer>
        <p class="copyright">Galería creada por Agos</p>
    </footer>
</body>
</html>