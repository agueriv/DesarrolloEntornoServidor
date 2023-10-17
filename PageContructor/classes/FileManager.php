<?php

class FileManager {
    
    function __construct() {
        
    }
    
    function newPage() {
        unlink('files/index.html');
        unlink('files/footerFile.txt');
        unlink('files/headerFile.txt');
        unlink('files/headFile.txt');
        unlink('files/mainFile.txt');
    }
    
    static function getIndex() {
        return file_get_contents('files/index.html');
    }
    
    function send($name, $target) {
        $number = 1;
        // Subimos la imagen
        $uploaded = $this->upload($name, $target);
        // Comprobamos si no se ha subido
        if(!$uploaded) {
            $number = 0;
        }
        return $number;
    }
    
    function upload(string $name, string $target) {
        // Si el $FILES del archivo pasado por parametro esta seteado (tiene valores)
        // y el tipo del archivo contiene 'image' (es una imagen)
        // y si no tiene errores
        if(isset($_FILES[$name]) &&
            $_FILES[$name]['error'] == 0 && 
                str_contains(mime_content_type($_FILES[$name]['tmp_name']), 'text')) {
                // Cambiamos el nombre del archivo añadiendole el prefijo
                $fileName = $name . '.txt'; // $_FILES[$name]['name'];
                // Devolvemos la salida de mover el archivo a la carpeta que queremos
                return move_uploaded_file($_FILES[$name]['tmp_name'], 'files/' . $fileName);
        }
        return false;
    }
    
    function writeFile() {
        $finalFile = fopen('files/index.html', 'w');
        fwrite($finalFile, '<!DOCTYPE html>');
        fwrite($finalFile, "\n");
        fwrite($finalFile, '<html lang="es">');
        fwrite($finalFile, "\n");
        fwrite($finalFile, file_get_contents('files/headFile.txt'));
        fwrite($finalFile, "\n");
        fwrite($finalFile, '<body>');
        fwrite($finalFile, "\n");
        fwrite($finalFile, file_get_contents('files/headerFile.txt'));
        fwrite($finalFile, "\n");
        fwrite($finalFile, file_get_contents('files/mainFile.txt'));
        fwrite($finalFile, "\n");
        fwrite($finalFile, file_get_contents('files/footerFile.txt'));
        fwrite($finalFile, "\n");
        fwrite($finalFile, '</body>');
        fwrite($finalFile, "\n");
        fwrite($finalFile, '</html>');
        fclose($finalFile);
    }
}