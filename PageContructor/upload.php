<?php

require('classes/FileManager.php');
require('classes/Files.php');

$fm = new FileManager();
// Borramos posibles archivos anteriores
$fm->newPage();

// Añadimos y movemos a la carpeta files los nuevos archivos que ha subido el user
$headTXT = $fm->send('headFile', 'files/');
$headTXT = $fm->send('mainFile', 'files/');
$headTXT = $fm->send('headerFile', 'files/');
$headTXT = $fm->send('footerFile', 'files/');

// Escribimos archivo final html
$fm->writeFile();

Files::redirect('sourceView.php');

