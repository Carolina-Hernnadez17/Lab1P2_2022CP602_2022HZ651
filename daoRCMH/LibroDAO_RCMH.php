<?php
require_once "configRCMH/ConexionRCMH.php";
require_once "modelosRCMH/LibroRCMH.php";

class LibroDAO_RCMH {
    private $conexion;

    public function __construct() {
        $this->conexion = (new ConexionRCMH())->getConexion();
    }

    public function listar() {
        $sql = "SELECT l.*, a.nombre as autor 
                FROM libros l 
                JOIN autores a ON l.id_autor=a.id_autor 
                ORDER BY l.titulo ASC";
        return $this->conexion->query($sql)->fetchAll();
    }

    public function agregar(LibroRCMH $libro) {
        $sql = "INSERT INTO libros (titulo, id_autor, portada, stock, disponible)
                VALUES (:titulo, :id_autor, :portada, :stock, :disponible)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':titulo' => $libro->titulo,
            ':id_autor' => $libro->idAutor,
            ':portada' => $libro->portada,
            ':stock' => $libro->stock,
            ':disponible' => $libro->disponible
        ]);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM libros WHERE id_libro=:id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch();
    }

    public function actualizar(LibroRCMH $libro) {
        $sql = "UPDATE libros SET titulo=:titulo, id_autor=:id_autor, portada=:portada, stock=:stock, disponible=:disponible
                WHERE id_libro=:id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':titulo'=>$libro->titulo,
            ':id_autor'=>$libro->idAutor,
            ':portada'=>$libro->portada,
            ':stock'=>$libro->stock,
            ':disponible'=>$libro->disponible,
            ':id'=>$libro->id
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM libros WHERE id_libro=:id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id'=>$id]);
    }

    public function comprar($id) {
        $libro = $this->obtener($id);
        if ($libro && $libro['stock'] > 0) {
            $nuevoStock = $libro['stock'] - 1;
            $disponible = $nuevoStock > 0 ? 1 : 0;
            $sql = "UPDATE libros SET stock=:stock, disponible=:disponible WHERE id_libro=:id";
            $stmt = $this->conexion->prepare($sql);
            return $stmt->execute([
                ':stock'=>$nuevoStock,
                ':disponible'=>$disponible,
                ':id'=>$id
            ]);
        }
        return false;
    }
}
?>
