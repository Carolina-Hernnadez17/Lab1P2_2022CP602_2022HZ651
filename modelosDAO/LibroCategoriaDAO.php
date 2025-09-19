<?php
require_once "config/conexion.php";
require_once "modelos/LibroCategoria.php";

class LibroCategoriaDAO {
    private $cn;

    public function __construct() {
        $this->cn = new ConexionRCMH();
    }

    public function add($id_libro, $id_categoria) {
        return $this->cn->ejecutar(
            "INSERT INTO libros_categorias (id_libro, id_categoria) VALUES (:id_libro, :id_categoria)",
            [":id_libro"=>$id_libro, ":id_categoria"=>$id_categoria]
        );
    }

    public function delete($id_libro, $id_categoria) {
        return $this->cn->ejecutar(
            "DELETE FROM libros_categorias WHERE id_libro=:id_libro AND id_categoria=:id_categoria",
            [":id_libro"=>$id_libro, ":id_categoria"=>$id_categoria]
        );
    }

    public function deleteByLibro($id_libro) {
        return $this->cn->ejecutar(
            "DELETE FROM libros_categorias WHERE id_libro=:id_libro",
            [":id_libro"=>$id_libro]
        );
    }

    public function getCategoriasByLibro($id_libro) {
        return $this->cn->consulta(
            "SELECT c.id_categoria, c.nombre
             FROM categorias c
             INNER JOIN libros_categorias lc ON c.id_categoria = lc.id_categoria
             WHERE lc.id_libro=:id_libro",
             [":id_libro"=>$id_libro]
        );
    }

    public function getLibrosByCategoria($id_categoria) {
        return $this->cn->consulta(
            "SELECT l.id_libro, l.titulo, l.id_autor, l.portada, l.disponible
             FROM libros l
             INNER JOIN libros_categorias lc ON l.id_libro = lc.id_libro
             WHERE lc.id_categoria=:id_categoria",
             [":id_categoria"=>$id_categoria]
        );
    }
}
?>
