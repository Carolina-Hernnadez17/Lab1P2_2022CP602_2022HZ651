<?php
class ContenidoRCMH {
    public function obtenerContenido($pagina){
        // Ajusta las rutas según tu proyecto
        switch($pagina){
            case 'autores':
                return __DIR__ . "/../vistasRCMH/autoresRCMH/listarAutoresRCMH.php";
            case 'libros':
                return __DIR__ . "/../vistasRCMH/librosRCMH/listarLibrosRCMH.php";
            case 'categorias':
                return __DIR__ . "/../vistasRCMH/categoriasRCMH/listarCategoriasRCMH.php";
            default:
                return __DIR__ . "/../vistasRCMH/inicioRCMH.php";
        }
    }
}
?>
