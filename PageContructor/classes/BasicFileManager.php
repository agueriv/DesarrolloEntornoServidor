<?php

// BasicFileManager.php, archivo se llama como la clase

// los archivos de php nunca se cierran al final, salvo que haya que cerrarlos, porque después hay algo

class BasicFileManager {

    // Forma de declarar el constructor de la clase
    function __construct() {
        
    }
    
    //Los métodos se implementan por orden alfabético
    
    function createFolder(string $name) {
        // Comprobamos si la carpeta ya esta creada, si no lo está la creamos a 
        // partir de la ruta que le mandamos como parámetro
        $created = false;
        if (!is_dir($name)) {
            mkdir($name);
            $created = true;
        }
        return $created;
    }

    // Borramos un archivo
    function deleteFile(string $name) {
        return unlink($name); //borrar archivos, ficheros
    }
    
    function move() {
        
    }

    // Función con la que devolvemos el prefijo usado para los nombres de nuestro archivos en el sistema
    private function prefix() {
        //aaaammddhhMMss
        // Objeto fecha
        $date = new DateTime();
        // Objeto zona horaria con nuestra zona horaria
        $timezone = new DateTimeZone('Europe/Madrid');
        // Cambiamos la zona horaria del objeto fecha
        $date->setTimezone($timezone);
        // Devolvemos la fecha en el formato que queremos
        return $date->format('YmdHis');
    }

    /**
     * ...
     * 
     * @return Integer It returns the number of uploaded files.
     * */
    function set($name, $target) {
        $number = 1;
        // Creamos la carpeta si existe y si no no se crea
        $created = $this->createFolder($target);
        // Subimos la imagen
        $uploaded = $this->upload($name, $target);
        // Comprobamos si no se ha subido
        if(!$uploaded) {
            // Si ha creado el directorio y no ha subido el fichero, borra el directorio
            if($created) {
                rmdir($target); //borrar carpetas, directorios
            }
            // Setea nuumber a 0 que significa error
            $number = 0;
        }
        return $number;
    }
    // Sube el archivo a nuestro servidor
    function upload(string $name, string $target) {
        // Si el $FILES del archivo pasado por parametro esta seteado (tiene valores)
        // y el tipo del archivo contiene 'image' (es una imagen)
        // y si no tiene errores
        if(isset($_FILES[$name]) &&
            $_FILES[$name]['error'] == 0) {
                // Cambiamos el nombre del archivo añadiendole el prefijo
                $fileName = $this->prefix() . '_' . $_FILES[$name]['name'];
                // Devolvemos la salida de mover el archivo a la carpeta que queremos
                return move_uploaded_file($_FILES[$name]['tmp_name'], $target . '/' . $fileName);
        }
        return false;
    }

}