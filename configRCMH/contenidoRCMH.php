<?php
class ContenidoRCMH {
    // URL base → clase controlador
    public static $contenido = [
        "autor" => "AutorControladorRCMH",
        "libro" => "LibroControladorRCMH",
        "categoria" => "CategoriaControladorRCMH"
    ];

    public function obtenerControlador($clave) {
        return self::$contenido[$clave] ?? null;
    }
}
?>
