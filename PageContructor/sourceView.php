<?php
    require('classes/FileManager.php');
    
    $contenido = FileManager::getIndex();
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Source View</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="img/ico.png">
</head>
<body>
    <h1>Source View</h1>
    <div class="container">
        <?= highlight_file("files/index.html", true) ?>
    </div>
    <a href="files/index.html" target="_BLANK">Ver página HTML resultante</a>
</body>
</html>