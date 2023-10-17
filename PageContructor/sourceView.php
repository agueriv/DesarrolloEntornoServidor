<?php
    require('classes/FileManager.php');
    
    $contenido = FileManager::getIndex();
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Source View</title>
</head>
<body>
    <h1>Source View</h1>
    <pre>
        <?= $contenido ?>
    </pre>
</body>
</html>