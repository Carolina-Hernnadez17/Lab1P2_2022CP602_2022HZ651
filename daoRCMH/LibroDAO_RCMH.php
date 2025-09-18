<?php
require_once "configRCMH/ConexionRCMH.php";
require_once "modelosRCMH/LibroRCMH.php";

class LibroDAO_RCMH {
    private $conexion;

    public function __construct(){
        $this->conexion = (new ConexionRCMH())->conectarRCMH();
    }

    // GETTER para la conexion
    public function getConexion(){
        return $this->conexion;
    }

    public function agregarRCMH(LibroRCMH $libro){
        $sql = "INSERT INTO libros (titulo, id_autor, portada, stock, disponible) 
                VALUES (:titulo, :id_autor, :portada, :stock, :disponible)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            'titulo'=>$libro->titulo,
            'id_autor'=>$libro->id_autor,
            'portada'=>$libro->portada,
            'stock'=>$libro->stock,
            'disponible'=>$libro->disponible
        ]);
    }

    public function listarRCMH(){
        $sql = "SELECT l.*, a.nombre AS autor_nombre
                FROM libros l
                INNER JOIN autores a ON l.id_autor = a.id_autor
                ORDER BY l.titulo ASC";
        return $this->conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRCMH($id_libro){
        $sql = "SELECT * FROM libros WHERE id_libro=:id_libro";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id_libro'=>$id_libro]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarRCMH(LibroRCMH $libro){
        $sql = "UPDATE libros SET titulo=:titulo, id_autor=:id_autor, portada=:portada, stock=:stock, disponible=:disponible
                WHERE id_libro=:id_libro";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            'titulo'=>$libro->titulo,
            'id_autor'=>$libro->id_autor,
            'portada'=>$libro->portada,
            'stock'=>$libro->stock,
            'disponible'=>$libro->disponible,
            'id_libro'=>$libro->id_libro
        ]);
    }

    public function eliminarRCMH($id_libro){
        $sql = "DELETE FROM libros WHERE id_libro=:id_libro";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute(['id_libro'=>$id_libro]);
    }

    public function comprarRCMH($id_libro){
        $sql = "UPDATE libros SET stock = stock - 1, disponible = IF(stock-1>0,1,0) WHERE id_libro=:id_libro AND disponible=1";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute(['id_libro'=>$id_libro]);
    }
}
?>
