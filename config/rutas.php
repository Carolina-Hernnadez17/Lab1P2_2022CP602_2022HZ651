<?php
define("RUTA", "http://localhost/Lab1P2_2022CP602_2022HZ651/");
require_once "conexion.php";

class Contenido {
    public function obtenerContenido($pagina, $accion = "index") {
        $archivo = "vistas/$pagina/$accion.php";
        if(file_exists($archivo)) {
            return $archivo;
        } else {
            // Si no existe la vista, devolvemos un archivo temporal que muestra mensaje simple
            return null;
        }
    }
}
?>
