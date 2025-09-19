<?php
define("RUTA", "http://localhost/Lab1P2_2022CP602_2022HZ651/");

class Contenido {
    public function obtenerContenido($pagina, $accion = "index") {
        $archivo = "vistas/$pagina/$accion.php";
        if(file_exists($archivo)) {
            return $archivo;
        } 
        return "vistas/404.php";
    }
}
?>
